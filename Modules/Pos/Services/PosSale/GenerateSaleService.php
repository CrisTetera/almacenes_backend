<?php

namespace Modules\Pos\Services\PosSale;

use Modules\Pos\Entities\PosSale;
use Modules\Sale\Entities\SlCustomer;
use Modules\Pos\Entities\PosDetailSale;
use Dotenv\Exception\ValidationException;
use Modules\Pos\Services\PosSale\CheckPosSaleService;
use Modules\Sale\Services\SlCustomer\CrudSlCustomerService;
use Modules\Pos\Services\PosSale\Entities\SaleData;
use Modules\Pos\Services\PosSale\Entities\DetailSaleData;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Modules\General\Services\RolePermissionService;
use Modules\General\Services\PermissionConstant;
use Modules\Sale\Services\SlCustomer\CustomerBranchOfficesService;
use Modules\Sale\Entities\SlCustomerBranchOffices;
use Modules\Pos\Entities\PosSaleInvoiceData;
use Modules\General\Entities\GUser;

class GenerateSaleService
{
    /** @var CheckPosSaleService $checkService */
    private $checkService;
    /** @var CrudSlCustomerService $crudSlCustomerService */
    private $crudSlCustomerService;
    /** @var StockReservationService $stockReservationService */
    private $stockReservationService;
    /** @var CalculateSaleService $calculateSaleService */
    private $calculateSaleService;
    /** @var RolePermissionService $rolePermissionService */
    private $rolePermissionService;
    /** @var CustomerBranchOfficesService $customerBranchOfficesService */
    private $customerBranchOfficesService;
    /**
     * Constructor
     *
     * @param CheckPosSaleService $checkService
     */
    function __construct(CheckPosSaleService $checkService,
                         CrudSlCustomerService $crudSlCustomerService,
                         StockReservationService $stockReservationService,
                         CalculateSaleService $calculateSaleService,
                         RolePermissionService $rolePermissionService,
                         CustomerBranchOfficesService $customerBranchOfficesService
        ) {
        $this->checkService = $checkService;
        $this->crudSlCustomerService = $crudSlCustomerService;
        $this->stockReservationService = $stockReservationService;
        $this->calculateSaleService = $calculateSaleService;
        $this->rolePermissionService = $rolePermissionService;
        $this->customerBranchOfficesService = $customerBranchOfficesService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function store($request)
    {
        $this->checkAuthCodes($request);
        $request->customer_id = $this->storeCustomerIfNotExists($request);

        $this->checkService->checkSaleHasProducts($request);

        /** @var SaleData $saleData */
        $saleData = $this->calculateSaleService->calculateSaleData($request);
        $this->checkService->checkTotals($saleData, $request->total);

        $posSale = $this->newPosSale($request, $saleData);
        $posSale->save();

        if ($posSale->isInvoice()) {
            $this->handleInvoiceData($posSale, $request);
        }

        // Insert each detail.
        /** @var DetailSaleData[] $detailSaleData */
        $detailSaleData = $saleData->getDetailSaleData();
        foreach( $detailSaleData as $detail ) {
            $detailSale = $this->newDetailPosSale($posSale->id, $detail);
            $detailSale->save();
        }

        $this->stockReservationService->storeStockReservation($posSale->id, $detailSaleData);

        return [
            'sale_id' => $posSale->id,
            'sale_id_formatted' => SaleConstant::PREFIX_SALE_NORMAL.str_pad("$posSale->id", 12, '0', STR_PAD_LEFT),
            'created_at' => $posSale->created_at,
        ];
    }

    /**
     * Check seller and supervisor auth code
     *
     * @param Request $request
     * @return void
     */
    public function checkAuthCodes(&$request)
    {
        $seller_user_id = $this->rolePermissionService->checkAuthorization($request->seller_user_code, PermissionConstant::POS_OPERAR_PUNTO_VENTA);
        $supervisor_user_id = null;
        if ( $request->has('supervisor_user_code') && $request->supervisor_user_code ) {
            $supervisor_user_id = $this->rolePermissionService->checkAuthorization($request->supervisor_user_code, PermissionConstant::POS_AUTORIZAR_TICKET_DE_VENTA);
        }
        $request->merge([
            'seller_user_id' => $seller_user_id,
            'supervisor_user_id' => $supervisor_user_id,
        ]);
    }

    /**
     * Store customer if not exists in database
     *
     * @param Request $request
     * @return integer
     */
    public function storeCustomerIfNotExists($request) {
        if (!$request->customer_id && $request->customer) {
            $customer = new SlCustomer();
            $this->crudSlCustomerService->setCustomerParams($customer, $request->customer);
            $this->crudSlCustomerService->saveCustomer($customer);
            if (!$customer) {
                throw new ValidationException('Ocurrió un error al intentar guardar cliente');
            }
            $this->customerBranchOfficesService->handleBranchOffices($customer, $request->customer['branch_offices']);
            return $customer->id;
        }
        return $request->customer_id;
    }

    /**
     * Handles invoice data
     *
     * @param PosSale $posSale
     * @param array $request
     * @return void
     */
    private function handleInvoiceData(PosSale $posSale, $request)
    {
        if ($request->has('purchase_order') && $request->purchase_order && ((int)$request->purchase_order) > 0)
        {
            $invoiceData = new PosSaleInvoiceData();
            $invoiceData->pos_sale_id = $posSale->id;
            $invoiceData->purchase_order = $request->purchase_order;
            $invoiceData->flag_delete = false;
            $invoiceData->save();
        }
    }

    /**
     * Generates a new pos sale
     *
     * @param  Modules\Pos\Services\PosSale\Entities\SaleData
     * @return PosSale
     */
    public function newPosSale($request, SaleData $saleData) {
        $this->checkService->checkBranchOffice($saleData->getBranchOfficeId());
        $this->checkService->checkCustomer($saleData->getCustomerId());
        $this->checkService->checkPosSaleType($saleData->getPosSaleTypeId());
        $this->checkService->checkIfCustomerRelatedWithInvoice($saleData->getCustomerId(), $saleData->getPosSaleTypeId());

        return new PosSale([
            'pos_customer_credit_option_id' => null,
            'pos_manual_discount_id' => null,
            'wh_sale_note_id' => null,
            'pos_sale_note_id' => null,
            'sl_customer_id' => $saleData->getCustomerId(),
            'sl_customer_branch_offices_id' => $this->getCustomerBranchOfficeId($saleData->getCustomerId(), $request),
            'pos_sale_type_id' => $saleData->getPosSaleTypeId(),
            'g_seller_user_id' => $request->has('seller_user_id') ? $request->seller_user_id : null,
            'g_supervisor_user_id' => $request->has('supervisor_user_id') ? $request->supervisor_user_id : null,
            'g_cashier_user_id' => null,
            'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
            'g_branch_office_id' => $saleData->getBranchOfficeId(),
            'pos_cash_desk_id' => null,
            'net_subtotal' => $saleData->getNetSubtotal(),
            'discount_or_charge_percentage' => $saleData->getDiscountOrChargePercentage(),
            'discount_or_charge_amount' => $saleData->getDiscountOrChargeAmount(),
            'new_net_subtotal' => $saleData->getNewNetSubtotal(),
            'exent_total' => $saleData->getExentTotal(),
            'iva' => $saleData->getIva(),
            'ticket_total' => $saleData->getTicketTotal(),
            'invoice_total' => $saleData->getInvoiceTotal(),
            'pos_origin_sale_id' => $this->getPosOriginSaleID($request->g_seller_user_id),
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
     * Generates a new detail pos sale
     *
     * @param integer $posSaleId
     * @param Modules\Pos\Services\PosSale\Entities\DetailSaleData $detail
     * @return PosDetailSale
     */
    public function newDetailPosSale($posSaleId, DetailSaleData $detail) {
        return new PosDetailSale([
            'line_number' => $detail->getLineNumber(),
            'wh_warehouse_id' => $detail->getWarehouseId(),
            'wh_product_id' => $detail->getProductId(),
            'pos_sale_id' => $posSaleId,
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

    /**
     * Get PosOriginSale ID with Id of Seller
     * 
     * @param int|nullable $idSeller
     * @return int with ID of PoOriginSale
     */
    public function getPosOriginSaleID($sellerUserId) {
        
        if(isset($sellerUserId))
        {
            $gUser = GUser::find($sellerUserId);
            switch($gUser->hrEmployee->sellerType()) {
                case SaleConstant::NORMAL_SELLER:
                    return SaleConstant::ORIGIN_SALE_NORMAL_ID;
                case SaleConstant::GROUND_SELLER:
                    return SaleConstant::ORIGIN_SALE_GROUND_ID;
                case SaleConstant::CALL_CENTER_SELLER:
                    return SaleConstant::ORIGIN_SALE_CALL_CENTER_ID;
            }
        }
        else
            return SaleConstant::ORIGIN_SALE_NORMAL_ID;
    }

}
