<?php

namespace Modules\Pos\Services\PosEmployeeSale;

use Modules\Pos\Services\PosSale\CalculateSaleService;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use App\Http\Response\CustomResponse;
use Illuminate\Support\Facades\DB;
use Modules\Pos\Entities\PosEmployeeSale;
use Modules\Pos\Entities\PosDetailEmployeeSale;
use Modules\HR\Entities\HrEmployee;
use Modules\General\Entities\GUser;
use Modules\Pos\Entities\PosEmployeeSaleStockReservation;
use Modules\Pos\Services\PosSale\CheckPosSaleService;
use Modules\Pos\Services\PosSale\Entities\SaleData;
use Modules\Pos\Services\PosSale\Entities\DetailSaleData;
use Modules\Warehouse\Entities\WhWarehouseItem;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Services\WhProduct\ProductInventoryService;
use Modules\General\Services\PermissionConstant;
use Modules\General\Services\RolePermissionService;


class GenerateEmployeeSaleService
{
    /** @var CheckPosSaleService $checkService */
    private $checkService;
    /** @var PosSaleEmployeeStockReservationService $stockReservationService */
    private $stockReservationService;
    /** @var CalculateSaleService $calculateSaleService */
    private $calculateSaleService;
    /** @var ProductInventoryService $productInventoryService */
    private $productInventoryService;
    /** @var RolePermissionService $rolePermissionService */
    private $rolePermissionService;

    /**
     * Constructor
     *
     * @param CheckPosSaleService $checkService
     */
    function __construct(CheckPosSaleService $checkService,
                         PosSaleEmployeeStockReservationService $stockReservationService,
                         CalculateSaleService $calculateSaleService,
                         ProductInventoryService $productInventoryService,
                         RolePermissionService $rolePermissionService) {
        $this->checkService = $checkService;
        $this->stockReservationService = $stockReservationService;
        $this->calculateSaleService = $calculateSaleService;
        $this->productInventoryService = $productInventoryService;
        $this->rolePermissionService = $rolePermissionService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * $request structure:
     *
     * [
     *   "employee_id" => 1,
     *   "g_seller_user_id" => 1,
     *   "g_supervisor_user_id" => 1,
     *   'sucursal_id' => 1,
     *   "global_discount" => 10, // En %
     *   "total" => 252, // Para validar los campos
     *   "sale_detail" => [
     *       [
     *           "product_id" => 1,
     *           "quantity" => 1,
     *           "price" => 100,
     *           "discount" => 10, // En %
     *           'discount_unit_price' => 0, // En monto
     *           'wh_warehouse_id' => 1
     *       ],
     *       [
     *           "product_id" => 2,
     *           "quantity" => 1,
     *           "price" => 200,
     *           "discount" => 0,
     *           'discount_unit_price' => 10, // En monto
     *           'wh_warehouse_id' => 1
     *      ]
     *    ]
     * ];
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function store($request)
    {
        try
        {
            DB::beginTransaction();

            $this->checkAuthCodes($request);
            $request->merge(['pos_sale_type' => SaleConstant::TICKET]);

            $this->checkService->checkSaleHasProducts($request);

            // Check employee, seller and supervisor
            HrEmployee::where('id', $request->employee_id)->where('flag_delete', false)->firstOrFail();

            /** @var SaleData $saleData */
            $saleData = $this->calculateSaleService->calculateSaleData($request);
            $this->checkService->checkTotals($saleData, $request->total);

            $posEmployeeSale = $this->newPosEmployeeSale($saleData, $request);
            $posEmployeeSale->save();

            // Insert each detail.
            /** @var DetailSaleData[] $detailSaleData @var DetailSaleData $detail */
            $detailSaleData = $saleData->getDetailSaleData();
            foreach( $detailSaleData as $detail ) {
                $this->checkService->checkProductPrice($detail->getProductId(), $request->sucursal_id);
                // Check
                $arr = [ [ 'id' => $detail->getProductId(), 'quantity' => $detail->getQuantity() ] ];
                $groupedItems = $this->productInventoryService->getGroupedItems($arr);
                $this->checkStock($detail->getWarehouseId(), $groupedItems);

                $detailSale = $this->newDetailPosEmployeeSale($posEmployeeSale->id, $detail);
                $detailSale->save();
            }

            $this->stockReservationService->storeStockReservation($posEmployeeSale->id, $detailSaleData);

            DB::commit();

            return CustomResponse::created([
                'employee_sale_id' => $posEmployeeSale->id,
                'employee_sale_id_formatted' => SaleConstant::PREFIX_SALE_EMPLOYEE.str_pad("$posEmployeeSale->id", 12, '0', STR_PAD_LEFT),
                'created_at' => $posEmployeeSale->created_at,
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return CustomResponse::error($e);
        }
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
        $supervisor_user_id = $this->rolePermissionService->checkAuthorization($request->supervisor_user_code, PermissionConstant::POS_AUTORIZAR_VENTA_A_PERSONAL);
        $request->merge([
            'seller_user_id' => $seller_user_id,
            'supervisor_user_id' => $supervisor_user_id,
        ]);
    }

    /**
     * Generates a new pos employee sale
     *
     * @param  Modules\Pos\Services\PosSale\Entities\SaleData $saleData
     * @param  array $request
     * @return void
     */
    public function newPosEmployeeSale(SaleData $saleData, $request) {
        $this->checkService->checkBranchOffice($saleData->getBranchOfficeId());
        return new PosEmployeeSale([
            'pos_employee_sale_payment_type_id' => null,
            'g_seller_user_id' => $request->seller_user_id,
            'g_supervisor_user_id' => $request->supervisor_user_id,
            'g_cashier_user_id' => null,
            'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
            'g_branch_office_id' => $saleData->getBranchOfficeId(),
            'pos_sale_type_id' => SaleConstant::TICKET,
            'sl_sale_ticket_id' => null,
            'pos_cash_desk_id' => null,
            'net_subtotal' => $saleData->getNetSubtotal(),
            'discount_or_charge_percentage' => $saleData->getDiscountOrChargePercentage(),
            'discount_or_charge_amount' => $saleData->getDiscountOrChargeAmount(),
            'new_net_subtotal' => $saleData->getNewNetSubtotal(),
            'exent_total' => $saleData->getExentTotal(),
            'iva' => $saleData->getIva(),
            'ticket_total' => $saleData->getTicketTotal(),
            'invoice_total' => $saleData->getInvoiceTotal(),
            'close_sale_datetime' => null,
            'flag_delete' => 0
        ]);
    }

    /**
     * Generates a new detail pos employee sale
     *
     * @param integer $posEmployeeSaleId
     * @param Modules\Pos\Services\PosSale\Entities\DetailSaleData $detail
     * @return void
     */
    public function newDetailPosEmployeeSale($posEmployeeSaleId, DetailSaleData $detail) {
        return new PosDetailEmployeeSale([
            'wh_product_id' => $detail->getProductId(),
            'line_number' => $detail->getLineNumber(),
            'pos_employee_sale_id' => $posEmployeeSaleId,
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
     * Check inventory from sale detail
     *
     * structure of $groupedItems array:
     * [
     *     "item_id" => 1,
     *     "item_quantity" => 1,
     *     "item_name' => 'Galletas'
     * ]
     *
     * @param integer $warehouseId
     * @param array $groupedItems
     * @return void
     */
    public function checkStock($warehouseId, $groupedItems)
    {
        foreach($groupedItems as $item)
        {
            $warehouse = WhWarehouseItem::where('wh_warehouse_id', $warehouseId)
                                        ->where('wh_item_id', $item['item_id'])
                                        ->where('flag_delete', false)->firstOrFail();
            if ($warehouse->stock < $item['item_quantity'])
            {
                throw new ValidationException("No hay stock suficiente (".$item['item_quantity'].") del item ".$item['item_name']." (encontrado: $warehouse->stock)");
            }
        }
    }
}
