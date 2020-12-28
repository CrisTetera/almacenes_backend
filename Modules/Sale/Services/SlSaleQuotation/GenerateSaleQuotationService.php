<?php

namespace Modules\Sale\Services\SlSaleQuotation;

use Modules\Pos\Services\PosSale\CheckPosSaleService;
use Modules\Sale\Services\SlCustomer\CrudSlCustomerService;
use Modules\Pos\Services\PosSale\CalculateSaleService;
use App\Http\Response\CustomResponse;
use Modules\Pos\Services\PosSale\Entities\SaleData;
use Modules\Sale\Entities\SlSaleQuotation;
use Dotenv\Exception\ValidationException;
use Modules\Sale\Entities\SlDetailSaleQuotation;
use Illuminate\Http\Request;
use DB;
use Modules\Pos\Services\PosSale\Entities\DetailSaleData;
use Modules\Sale\Entities\SlCustomer;
use Modules\Sale\Services\SlCustomer\CustomerBranchOfficesService;
use Modules\Sale\Entities\SlCustomerBranchOffices;

class GenerateSaleQuotationService
{

    /** @var CheckPosSaleService $checkService */
    private $checkService;
    /** @var CrudSlCustomerService $crudSlCustomerService */
    private $crudSlCustomerService;
    /** @var CalculateSaleService $calculateSaleService */
    private $calculateSaleService;
    /** @var CustomerBranchOfficeService $customerBranchOfficesService */
    private $customerBranchOfficesService;
    /** @var SendEmailToSlCustomerWithPDF_SaleQuotationService $sendEmailToSlCustomerWithPDF_SaleQuotationService */
    private $sendEmailToSlCustomerWithPDF_SaleQuotationService;

    /**
     * Constructor
     *
     * @param CheckPosSaleService $checkService
     * @param CrudSlCustomerService $crudSlCustomerService
     * @param CalculateSaleService $calculateSaleService
     */
    function __construct(CheckPosSaleService $checkService,
                         CrudSlCustomerService $crudSlCustomerService,
                         CalculateSaleService $calculateSaleService,
                         CustomerBranchOfficesService $customerBranchOfficesService,
                         SendEmailToSlCustomerWithPDF_SaleQuotationService $sendEmailToSlCustomerWithPDF_SaleQuotationService)
    {
        $this->checkService = $checkService;
        $this->crudSlCustomerService = $crudSlCustomerService;
        $this->calculateSaleService = $calculateSaleService;
        $this->customerBranchOfficesService = $customerBranchOfficesService;
        $this->sendEmailToSlCustomerWithPDF_SaleQuotationService = $sendEmailToSlCustomerWithPDF_SaleQuotationService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function store($request)
    {
        DB::beginTransaction();
        try
        {
            // Customer is a must in request
            $this->checkCustomer($request);
            $request->customer_id = $this->storeCustomerIfNotExists($request);

            $this->checkService->checkSaleHasProducts($request);

            /** @var SaleData $saleData */
            $saleData = $this->calculateSaleService->calculateSaleData($request);

            // TODO: Uncomment This
            // $this->checkService->checkTotals($saleData, $request->total);
            // TODO: Remove lines 68 - 73
            // For now, always check invoice
            $totalVenta = $saleData->getInvoiceTotal();
            $total = $request->total;
            if ($total !== $totalVenta) {
                throw new ValidationException("El total de la venta ($totalVenta) no corresponde al total enviado ($total).");
            }

            $saleQuotation = $this->newSaleQuotation($saleData, $request);
            $saleQuotation->save();
            $saleQuotation->number = str_pad("$saleQuotation->id", 12, '0', STR_PAD_LEFT);
            $saleQuotation->save();

            // Insert each detail.
            /** @var DetailSaleData[] $detailSaleData @var DetailSaleData $detail */
            $detailSaleData = $saleData->getDetailSaleData();
            foreach( $detailSaleData as $detail ) {
                $detailSale = $this->newDetailSaleQuotation($saleQuotation->id, $detail);
                $detailSale->save();
            }
            // Send email with SaleQuotation PDF to SlCustomer
            $this->sendEmailToSlCustomerWithPDF_SaleQuotationService
                 ->sendEmailToSlCustomerWithPDF_SaleQuotation($saleQuotation);

            DB::commit();

            return CustomResponse::created([
                'quotation_id' => $saleQuotation->id,
                'quotation_id_formatted' => $saleQuotation->number,
                'created_at' => $saleQuotation->created_at
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return CustomResponse::error($e);
        }
    }

    /**
     * Check if customer is present in request (customer_id or customer data)
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function checkCustomer(Request $request) {
        if (!$request->customer_id && !$request->customer) {
            throw new ValidationException('Debe enviar el id del cliente, o los datos del cliente');
        }
    }

    /**
     * Store customer if not exists in database
     *
     * @param Illuminate\Http\Request $request
     * @return integer
     */
    public function storeCustomerIfNotExists($request) {
        if (!$request->customer_id && $request->customer) {
            $customer = new SlCustomer();
            $this->crudSlCustomerService->setCustomerParams($customer, $request->customer);
            $this->crudSlCustomerService->saveCustomer($customer);
            $this->customerBranchOfficesService->handleBranchOffices($customer, $request->customer['branch_offices']);
            return $customer->id;
        }
        return $request->customer_id;
    }

     /**
     * Generates a new sale quotation
     *
     * @param  Modules\Pos\Services\PosSale\Entities\SaleData
     * @return void
     */
    public function newSaleQuotation(SaleData $saleData, $request) {
        // TODO: Asociar g_user_id al usuario real.
        $this->checkService->checkBranchOffice($saleData->getBranchOfficeId());
        $this->checkService->checkCustomer($saleData->getCustomerId());
        $this->checkService->checkPosSaleType($saleData->getPosSaleTypeId());
        return new SlSaleQuotation([
            'number' => '',
            'emission_date' => date('Y-m-d'),
            'sl_customer_id' => $saleData->getCustomerId(),
            'sl_customer_branch_offices_id' => $this->getCustomerBranchOfficeId($saleData->getCustomerId(), $request),
            'net_subtotal' => $saleData->getNetSubtotal(),
            'discount_or_charge_percentage' => $saleData->getDiscountOrChargePercentage(),
            'new_net_subtotal' => $saleData->getNewNetSubtotal(),
            'exent_total' => $saleData->getExentTotal(),
            'iva' => $saleData->getIva(),
            'ticket_total' => $saleData->getTicketTotal(),
            'invoice_total' => $saleData->getInvoiceTotal(),
            'pos_sale_type_id' => $saleData->getPosSaleTypeId(),
            'g_user_id' => null,
            'g_branch_office_id' => $saleData->getBranchOfficeId(),
            'flag_delete' => 0
        ]);
    }

    private function getCustomerBranchOfficeId($customerId, $request)
    {
        $customerBranchOfficeId = null;
        if (isset($request['default_branch_office_id']) && $request->default_branch_office_id) {
            $customerBranchOfficeId = $request->default_branch_office_id;
        } else {
            $customerBranchOffices = SlCustomerBranchOffices::where('sl_customer_id', $customerId)->where('flag_delete', 0)->orderBy('id', 'asc')->get()->toArray();
            $index = $request->has('default_branch_office_index') ? $request->default_branch_office_index : 0;
            if (count($customerBranchOffices) > $index) {
                $customerBranchOfficeId = $customerBranchOffices[$index]['id'];
            }
        }
        return $customerBranchOfficeId;
    }

    /**
     * Generates a new detail sale quotation
     *
     * @param integer $saleQuotationId
     * @param Modules\Pos\Services\PosSale\Entities\DetailSaleData $detail
     * @return void
     */
    public function newDetailSaleQuotation($saleQuotationId, DetailSaleData $detail) {
        return new SlDetailSaleQuotation([
            'sl_sale_quotation_id' => $saleQuotationId,
            'wh_product_id' => $detail->getProductId(),
            'quantity' => $detail->getQuantity(),
            'price' => $detail->getPrice(),
            'net_price' => $detail->getNetPrice(),
            'net_subtotal' => $detail->getnetSubtotal(),
            'discount_or_charge_percentage' => $detail->getDiscountOrChargePercentage(),
            'discount_or_charge_value' => $detail->getDiscountOrChargeValue(),
            'new_net_subtotal' => $detail->getNewNetSubtotal(),
            'total' => $detail->getTotal(),
            'flag_delete' => false
        ]);
    }

}
