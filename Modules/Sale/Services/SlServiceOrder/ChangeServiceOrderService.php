<?php

namespace Modules\Sale\Services\SlServiceOrder;

use App\Http\Response\CustomResponse;
use Illuminate\Http\Request;
use Modules\Sale\Http\Requests\SlServiceOrder\ChangeServiceOrderRequest;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Illuminate\Support\Facades\DB;
use Modules\Sale\Entities\SlSaleTicket;
use Modules\Sale\Entities\SlSaleInvoice;
use Modules\Sale\Entities\SlServiceOrder;
use Modules\Warehouse\Entities\WhProduct;
use Modules\Sale\Entities\SlServiceOrderProductChange;
use Dotenv\Exception\ValidationException;
use Modules\Pos\Services\PosSale\GenerateSaleService;
use Modules\Warehouse\Services\WhProduct\ProductInventoryService;
use Modules\Warehouse\Entities\WhWarehouse;
use Modules\Warehouse\Entities\WhWarehouseItem;
use Modules\Pos\Entities\PosSale;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Modules\General\Services\RolePermissionService;
use Modules\General\Services\PermissionConstant;

class ChangeServiceOrderService
{

    /** @var GenerateSaleService $generateSaleService */
    private $generateSaleService;

    /** @var ProductInventoryService $productInventoryService */
    private $productInventoryService;

    /** @var RolePermissionService $rolePermissionService */
    private $rolePermissionService;

    public function __construct(
        GenerateSaleService $generateSaleService,
        ProductInventoryService $productInventoryService,
        RolePermissionService $rolePermissionService
    )
    {
        $this->generateSaleService = $generateSaleService;
        $this->productInventoryService = $productInventoryService;
        $this->rolePermissionService = $rolePermissionService;
    }

    /**
     * Generates a new order service for change product
     *
     * @param Modules\Sale\Http\Requests\SlServiceOrder\ChangeServiceOrderRequest $request
     * @return void
     */
    public function store(ChangeServiceOrderRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->checkAuthCodes($request);

            $resp = null;
            if ( $request->is_ticket ) {
                $ticket = SlSaleTicket::where('number', $request->dte_number)->where('flag_delete', false)->firstOrFail();
                if ($ticket->was_replaced) {
                    throw new ValidationException("Esta boleta ya ha sido anulada o reemplazada");
                }
                $ticket->was_replaced = true;
                $ticket->save();
                $resp = $this->changeTicket($request, $ticket);
            } else {
                $invoice = SlSaleInvoice::where('number', $request->dte_number)->where('flag_delete', false)->firstOrFail();
                if ($invoice->was_replaced) {
                    throw new ValidationException("Esta factura ya ha sido anulada o reemplazada");
                }
                $invoice->was_replaced = true;
                $invoice->save();
                $resp = $this->changeInvoice($request, $invoice);
            }
            if ((int) $resp['http_status_code'] >= 400) {
                DB::rollBack();
                return $resp;
            }
            DB::commit();
            return $resp;
        } catch(\Exception $e) {
            DB::rollBack();
            if ( $e instanceof LaravelValidationException ) throw $e;
            return CustomResponse::error($e);
        }
    }

    /**
     * Check seller and supervisor auth code
     *
     * @param ChangeServiceOrderRequest $request
     * @return void
     */
    public function checkAuthCodes(&$request)
    {
        $seller_user_id = $this->rolePermissionService->checkAuthorization($request->seller_user_code, PermissionConstant::POS_OPERAR_PUNTO_VENTA);
        $supervisor_user_id = $this->rolePermissionService->checkAuthorization($request->supervisor_user_code, PermissionConstant::POS_AUTORIZAR_CAMBIO_PRODUCTOS);
        $request->merge([
            'seller_user_id' => $seller_user_id,
            'supervisor_user_id' => $supervisor_user_id,
        ]);
    }

    /**
     * Change ticket service order
     *
     * @param Modules\Sale\Http\Requests\SlServiceOrder\ChangeServiceOrderRequest $request
     * @param Modules\Sale\Entities\SlSaleTicket $ticket
     * @return Response
     */
    public function changeTicket(ChangeServiceOrderRequest $request, SlSaleTicket $ticket)
    {
        // New service order.
        $detailSaleTickets = $ticket->slDetailSaleTickets()->get();
        $serviceOrder = $this->newServiceOrder($request, $ticket->id, null);
        return $this->handleChange($request, $serviceOrder, $detailSaleTickets);
    }

    /**
     * Change invoice service order
     *
     * @param Modules\Sale\Http\Requests\SlServiceOrder\ChangeServiceOrderRequest $request
     * @param Modules\Sale\Entities\SlSaleInvoice $invoice
     * @return Response
     */
    public function changeInvoice(ChangeServiceOrderRequest $request, SlSaleInvoice $invoice)
    {
        $detailSaleInvoices = $invoice->slDetailSaleInvoices()->get();
        $serviceOrder = $this->newServiceOrder($request, null, $invoice->id);
        return $this->handleChange($request, $serviceOrder, $detailSaleInvoices);
    }

    /**
     * Handle changes
     *
     * $detailDTE: ['wh_product_id' => X, 'quantity' => X, ...]
     *
     * @param ChangeServiceOrderRequest $request
     * @param array $detailDTE
     * @return Response
     */
    public function handleChange(ChangeServiceOrderRequest $request, SlServiceOrder $serviceOrder, $detailDTE)
    {
        $serviceOrder->save();
        $this->handleInRequest($request, $serviceOrder, $detailDTE);
        $this->handleOutRequest($request, $serviceOrder, $detailDTE);
        $resp = $this->generateSaleService->store($request);
        if ((int)$resp['http_status_code'] >= 400) {
            return $resp;
        }
        $sale = PosSale::where('id', $resp['sale_id'])->first();
        $this->checkTotalAmount($request, $sale, $detailDTE);
        return array_merge($resp, [
            'service_order_id' => $serviceOrder->id,
            'service_order_created_at' => $serviceOrder->created_at,
        ]);
    }

    /**
     * Check if total sale is equal or greater than the total amount of product's to change
     * If not, throws DotEnv\Exception\ValidationException
     * @param ChangeServiceOrderRequest $request
     * @param PosSale $sale
     * @param array $detailDTE
     * @return void
     */
    public function checkTotalAmount(ChangeServiceOrderRequest $request, PosSale $sale, $detailDTE)
    {
        $totalSale = $request->is_ticket ? $sale->ticket_total : $sale->invoice_total;
        $totalProductDTE = 0;
        // Calculates total product DTE
        foreach( $request->in as $product ) {
            $detailDTE->each(function($item, $key) use ($product, $request, &$totalProductDTE) {
                if ( $product['product_id'] == $item['wh_product_id'] ) {
                    $totalLine = $item['subtotal'] * $product['quantity'] / $item['quantity'];
                    $totalProductDTE += $request->is_ticket ? (int) round($totalLine) : (int) round($totalLine * (1 + SaleConstant::IVA));
                }
            });
        }
        // Para q no haya problema:
        $totalSale = $totalSale + (int) $request->global_discount_amount;
        if ( $totalSale < $totalProductDTE ) {
            throw new ValidationException("El total de la venta ($totalSale) no puede ser menor al total de los productos a cambiar ($totalProductDTE)");
        }
    }

    /**
     * Handle "in" request
     *
     * $detailDTE: ['wh_product_id' => X, 'quantity' => X, ...]
     *
     * @param ChangeServiceOrderRequest $request
     * @param array $detailDTE
     * @return void
     */
    public function handleInRequest(ChangeServiceOrderRequest $request, SlServiceOrder $serviceOrder, $detailDTE)
    {
        $wasteWarehouse = WhWarehouse::where('g_branch_office_id', $request->sucursal_id)
                                    ->where('is_waste_warehouse', true)
                                    ->where('flag_delete', false)
                                    ->orderBy('id', 'asc')
                                    ->firstOrFail();
        foreach( $request->in as $inProduct )
        {
            $product = WhProduct::where('id', $inProduct['product_id'])->where('flag_delete', false)->firstOrFail();
            $this->checkProductInDTE($product, $inProduct['quantity'], $detailDTE);
            $change = $this->newServiceOrderProductChange($serviceOrder, $product, $inProduct['quantity'], ServiceOrderConstant::CHANGE_IN);
            $change->save();
            $this->moveProductToWasteWarehouse($wasteWarehouse, $product, $inProduct['quantity']);
        }
    }

    /**
     * Handle "out" request
     *
     * $detailDTE: ['wh_product_id' => X, 'quantity' => X, ...]
     *
     * @param ChangeServiceOrderRequest $request
     * @param array $detailDTE
     * @return void
     */
    public function handleOutRequest(ChangeServiceOrderRequest $request, SlServiceOrder $serviceOrder, $detailDTE)
    {
        foreach( $request->sale_detail as $saleDetail )
        {
            $product = WhProduct::where('id', $saleDetail['product_id'])->where('flag_delete', false)->firstOrFail();
            $change = $this->newServiceOrderProductChange($serviceOrder, $product, $saleDetail['quantity'], ServiceOrderConstant::CHANGE_OUT);
            $change->save();
        }
    }

    /**
     * Return a new service order
     *
     * @param ChangeServiceOrderRequest $request
     * @param int $ticketId
     * @param int $invoiceId
     * @return SlServiceOrder
     */
    public function newServiceOrder(ChangeServiceOrderRequest $request, $ticketId, $invoiceId)
    {
        return new SlServiceOrder([
            'g_seller_user_id' => $request->seller_user_id,
            'g_supervisor_user_id' => $request->supervisor_user_id,
            'sl_sale_ticket_id' => $ticketId,
            'sl_sale_invoice_id' => $invoiceId,
            'sl_sale_ticket_id2' => null,
            'sl_sale_invoice_id2' => null,
            'comment' => $request->comment ? $request->comment : '',
            'sl_service_order_type_id' => ServiceOrderConstant::SERVICE_ORDER_TYPE_CHANGE,
            'flag_delete' => false
        ]);
    }

    /**
     * Return a new service order change
     *
     * @param SlServiceOrder $serviceOrder
     * @param WhProduct $product
     * @param int $quantity
     * @param string $movementType
     * @return SlServiceOrderProductChange
     */
    public function newServiceOrderProductChange(SlServiceOrder $serviceOrder, WhProduct $product, $quantity, $movementType)
    {
        return new SlServiceOrderProductChange([
            'sl_service_order_id' => $serviceOrder->id,
            'wh_product_id' => $product->id,
            'quantity' => $quantity,
            'movement_type' => $movementType,
            'flag_delete' => false
        ]);
    }

    /**
     * Check if product and quantity are present in DTE,
     * if not, throw a Dotenv\Exception\ValitadionException
     *
     * @param WhProduct $product
     * @param int $quantity
     * @param array $detailDTE
     * @return void
     */
    public function checkProductInDTE(WhProduct $product, $quantity, $detailDTE)
    {
        $productFound = false;
        $quantityIsLessThanOrEqual = false;
        $quantityInTicket = 0;
        // Check if product exists, and check y quantity is less than or equal quantity in ticket/invoice
        $detailDTE->each(function($item, $key) use ($product, $quantity, &$productFound, &$quantityIsLessThanOrEqual, &$quantityInTicket) {
            if ($product->id == $item['wh_product_id']) {
                $productFound = true;
                $quantityIsLessThanOrEqual = $quantity <= $item['quantity'];
                $quantityInTicket = (int) $item['quantity'];
                return false;
            }
        });
        if (!$productFound) {
            throw new ValidationException("Producto '$product->name' no puede ingresar. No se encontró en el documento");
        }
        if (!$quantityIsLessThanOrEqual) {
            throw new ValidationException("La cantidad a cambiar ($quantity) supera a la cantidad del documento ($quantityInTicket)");
        }

    }

    /**
     * Move products to waste warehouse
     *
     * @param WhWarehouse $warehouse
     * @param WhProduct $product
     * @param integer $quantity
     * @return void
     */
    public function moveProductToWasteWarehouse(WhWarehouse $warehouse, WhProduct $product, $quantity)
    {
        $groupedItems = $this->productInventoryService->getGroupedItems([ ['id' => $product->id, 'quantity' => $quantity] ]);
        foreach( $groupedItems as $item )
        {
            $warehouseItem = WhWarehouseItem::where('wh_warehouse_id', $warehouse->id)
                                            ->where('wh_item_id', $item['item_id'])
                                            ->where('flag_delete', false)
                                            ->first();
            if ( !$warehouseItem ) { //Generates new file in table
                $warehouseItem = new WhWarehouseItem([
                    'wh_warehouse_id' => $warehouse->id,
                    'wh_item_id' => $item['item_id'],
                    'stock' => $item['item_quantity'],
                    'flag_delete' => false
                ]);
            } else { // Increments by quantity
                $warehouseItem->stock += $item['item_quantity'];
            }
            $warehouseItem->save();
        }
    }

}
