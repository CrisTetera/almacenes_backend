<?php

namespace Modules\Pos\Services\PosInternalConsumption;

use Modules\Pos\Services\PosSale\CheckPosSaleService;
use Illuminate\Http\Request;
use Modules\Pos\Entities\PosInternalConsumption;
use Modules\Pos\Entities\PosDetailInternalConsumption;
use Modules\Warehouse\Entities\WhProduct;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\HR\Entities\HrEmployee;
use Modules\General\Entities\GUser;
use Modules\Warehouse\Services\WhProduct\ProductInventoryService;
use Modules\Warehouse\Entities\WhWarehouseItem;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Modules\General\Services\PermissionConstant;
use Modules\General\Services\RolePermissionService;


class GenerateInternalConsumptionService
{

    /** @var CheckPosSaleService $checkService */
    private $checkService;
    /** @var ProductInventoryService $productInventoryService */
    private $productInventoryService;
    /** @var RolePermissionService $rolePermissionService */
    private $rolePermissionService;

    /**
     * Constructor
     *
     * @param CheckPosSaleService $checkService
     */
    function __construct(
        CheckPosSaleService $checkService,
        ProductInventoryService $productInventoryService,
        RolePermissionService $rolePermissionService
    ) {
        $this->checkService = $checkService;
        $this->productInventoryService = $productInventoryService;
        $this->rolePermissionService = $rolePermissionService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * Request structure:
     *
     * [
     *   "description" => 'Esto es un consumo interno',
     *   'requester_employee_id' => 1,
     *   "seller_user_id" => 1,
     *   "sucursal_id" => 1,
     *   "sale_detail" => [
     *       [
     *           "product_id" => 1,
     *           "quantity" => 1,
     *           'wh_warehouse_id' => 1
     *       ],
     *       [
     *           "product_id" => 2,
     *           "quantity" => 1,
     *           'wh_warehouse_id' => 1
     *       ]
     *   ]
     * ]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store($request)
    {
        try {
            DB::beginTransaction();
            $this->checkAuthCodes($request);

            $this->checkService->checkSaleHasProducts($request);

            // Check requester.
            HrEmployee::where('id', $request['requester_employee_id'])->where('flag_delete', false)->firstOrFail();

            $posInternalConsumption = $this->newInternalConsumption($request);
            $posInternalConsumption->save();

            foreach( $request['sale_detail'] as $detail )
            {
                $detailSale = $this->newDetailInternalConsumption($posInternalConsumption->id, $detail);
                $detailSale->save();

                // Check stock and decrement
                $arr = [ ['id' => $detail['product_id'], 'quantity' => $detail['quantity']] ];
                $groupedItems = $this->productInventoryService->getGroupedItems($arr);
                $this->checkStock($detail['wh_warehouse_id'], $groupedItems);
                $this->decrementInventory($detail['wh_warehouse_id'], $groupedItems);
            }

            DB::commit();

            return CustomResponse::created([
                'internal_consumption_id' => $posInternalConsumption->id,
                'internal_consumption_id_formatted' => SaleConstant::PREFIX_SALE_INTERNAL.str_pad("$posInternalConsumption->id", 12, '0', STR_PAD_LEFT),
                'created_at' => $posInternalConsumption->created_at
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return CustomResponse::error($e);
        }
    }

    /**
     * Check seller auth code
     *
     * @param Request $request
     * @return void
     */
    public function checkAuthCodes(&$request)
    {
        $seller_user_id = $this->rolePermissionService->checkAuthorization($request->seller_user_code, PermissionConstant::POS_OPERAR_PUNTO_VENTA);
        $request->merge([
            'seller_user_id' => $seller_user_id
        ]);
    }

    /**
     * Generates a new pos internal consumption
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function newInternalConsumption($request) {
        $this->checkService->checkBranchOffice($request['sucursal_id']);
        return new PosInternalConsumption([
            'description' => $request['description'],
            'hr_requester_employee_id' => $request['requester_employee_id'],
            'g_seller_user_id' => $request['seller_user_id'],
            'g_branch_office_id' => $request['sucursal_id'],
            'flag_delete' => 0
        ]);
    }

    /**
     * Generates a new detail pos internal consumption
     *
     * structure of $detail array:
     * [
     *     [
     *         "product_id" => 1,
     *         "quantity" => 1,
     *         'wh_warehouse_id' => 1
     *     ],
     *     [
     *         "product_id" => 2,
     *         "quantity" => 1,
     *         'wh_warehouse_id' => 1
     *     ]
     * ]
     *
     * @param integer $posInternalConsumptionId
     * @param array $detail
     * @return void
     */
    public function newDetailInternalConsumption($posInternalConsumptionId, $detail) {
        $product = WhProduct::where('id', $detail['product_id'])->where('flag_delete', 0)->firstOrFail();
        $this->checkIfProductIsConsumable($product);
        return new PosDetailInternalConsumption([
            'wh_product_id' => $detail['product_id'],
            'pos_internal_consumption_id' => $posInternalConsumptionId,
            'quantity' => $detail['quantity'],
            'flag_delete' => false
        ]);
    }

    /**
     * Check if product is consumable,
     * if not, throw ValidationException
     *
     * @param WhProduct $product
     * @return void
     */
    public function checkIfProductIsConsumable(WhProduct $product)
    {
        if (!$product->is_consumable)
        {
            throw new ValidationException("El producto '".$product->name."' no es apto para consumo interno");
        }
    }

    /**
     * Decrement inventory from sale detail
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
    public function decrementInventory($warehouseId, $groupedItems)
    {
        foreach($groupedItems as $item)
        {
            WhWarehouseItem::where('wh_warehouse_id', $warehouseId)
                    ->where('wh_item_id', $item['item_id'])
                    ->where('flag_delete', false)
                    ->decrement('stock', $item['item_quantity']);
        }
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
