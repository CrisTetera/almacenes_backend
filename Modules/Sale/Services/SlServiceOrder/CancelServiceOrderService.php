<?php

namespace Modules\Sale\Services\SlServiceOrder;

use Modules\Warehouse\Services\WhProduct\ProductInventoryService;
use Modules\General\Services\RolePermissionService;
use App\Http\Response\CustomResponse;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Illuminate\Support\Facades\DB;
use Modules\Sale\Entities\SlSaleTicket;
use Dotenv\Exception\ValidationException;
use Modules\General\Services\PermissionConstant;
use Modules\Sale\Entities\SlServiceOrder;
use Modules\Sale\Entities\SlSaleInvoice;
use Modules\Pos\Entities\PosSale;
use Modules\Sale\Http\Requests\SlServiceOrder\CancelServiceOrderRequest;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Modules\Pos\Services\PosSale\OpenSalesRollbackService;
use Modules\Pos\Entities\PosSaleStockReservation;
use Modules\Sale\Services\SlCreditNote\CrudSlSaleCreditNoteService;
use Modules\Pos\Services\PosSale\DteGenerateCreditNoteService;

class CancelServiceOrderService
{

    /** @var ProductInventoryService $productInventoryService */
    private $productInventoryService;

    /** @var RolePermissionService $rolePermissionService */
    private $rolePermissionService;

    /** @var OpenSalesRollbackServices $openSalesRollbackService */
    private $openSalesRollbackService;
    
    /** @var DteGenerateCreditNoteService $dteGenerateCreditNoteService */
    private $dteGenerateCreditNoteService;

    public function __construct(
        ProductInventoryService $productInventoryService,
        RolePermissionService $rolePermissionService,
        OpenSalesRollbackService $openSalesRollbackService
    )
    {
        $this->productInventoryService = $productInventoryService;
        $this->rolePermissionService = $rolePermissionService;
        $this->openSalesRollbackService = $openSalesRollbackService;
    }

    /**
     * Generates a new order service for change product
     *
     * @param Modules\Sale\Http\Requests\SlServiceOrder\CancelServiceOrderRequest $request
     * @return void
     */
    public function store(CancelServiceOrderRequest $request)
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
                $resp = $this->cancelTicket($request, $ticket);
            } else {
                $invoice = SlSaleInvoice::where('number', $request->dte_number)->where('flag_delete', false)->firstOrFail();
                if ($invoice->was_replaced) {
                    throw new ValidationException("Esta factura ya ha sido anulada o reemplazada");
                }
                $invoice->was_replaced = true;
                $invoice->save();
                $resp = $this->cancelInvoice($request, $invoice);
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
     * @param CancelServiceOrderRequest $request
     * @return void
     */
    public function checkAuthCodes(CancelServiceOrderRequest &$request)
    {
        $seller_user_id = $this->rolePermissionService->checkAuthorization($request->seller_user_code, PermissionConstant::POS_OPERAR_PUNTO_VENTA);
        $supervisor_user_id = $this->rolePermissionService->checkAuthorization($request->supervisor_user_code, PermissionConstant::POS_AUTORIZAR_ANULACION_DTE);
        $request->merge([
            'seller_user_id' => $seller_user_id,
            'supervisor_user_id' => $supervisor_user_id,
        ]);
    }

    /**
     * Cancel ticket service order
     *
     * @param Modules\Sale\Http\Requests\SlServiceOrder\CancelServiceOrderRequest $request
     * @param Modules\Sale\Entities\SlSaleTicket $ticket
     * @return Response
     */
    public function cancelTicket(CancelServiceOrderRequest $request, SlSaleTicket $ticket)
    {
        // New service order.
        $detailSaleTickets = $ticket->slDetailSaleTickets()->get();
        $serviceOrder = $this->newServiceOrder($request, $ticket->id, null);
        $sale = PosSale::where('flag_delete', false)->where('sl_sale_ticket_id', $ticket->id)->first();
        if (!$sale) {
            throw new ValidationException("No hay ninguna venta asociada");
        }
        return $this->handleCancel($request, $serviceOrder, $sale, $detailSaleTickets);
    }

    /**
     * Cancel invoice service order
     *
     * @param Modules\Sale\Http\Requests\SlServiceOrder\CancelServiceOrderRequest $request
     * @param Modules\Sale\Entities\SlSaleInvoice $invoice
     * @return Response
     */
    public function cancelInvoice(CancelServiceOrderRequest $request, SlSaleInvoice $invoice)
    {
        $detailSaleInvoices = $invoice->slDetailSaleInvoices()->get();
        $serviceOrder = $this->newServiceOrder($request, null, $invoice->id);
        $sale = PosSale::where('flag_delete', false)->where('sl_sale_invoice_id', $invoice->id)->first();
        if (!$sale) {
            throw new ValidationException("No hay ninguna venta asociada");
        }
        return $this->handleCancel($request, $serviceOrder, $sale, $detailSaleInvoices);
    }

    /**
     * Handle cancel
     *
     * $detailDTE: ['wh_product_id' => X, 'quantity' => X, ...]
     *
     * @param CancelServiceOrderRequest $request
     * @param PosSale $sale
     * @param array $detailDTE
     * @return Response
     */
    public function handleCancel(CancelServiceOrderRequest $request, SlServiceOrder $serviceOrder, PosSale $sale, $detailDTE)
    {
        $serviceOrder->save();
        $this->checkIfSaleCanBeCancelled($sale);
        $sale->g_state_id = SaleConstant::SALE_STATE_ANULADA;
        // Rollback a la reserva ( Volver a añadir lo de la reserva al inventario )
        $posSaleReservations = PosSaleStockReservation::where('pos_sale_id', $sale->id)->get();
        foreach($posSaleReservations as $posSaleReservation) {
            $this->openSalesRollbackService->itemStockRollback($posSaleReservation);
        }
        $sale->save();

        // Generate Credit Note DTE in Open Factura
        $dteGenerateCreditNoteService = new DteGenerateCreditNoteService();
        $dteResponse = $dteGenerateCreditNoteService->generateCreditNote_OfSale($sale);

        if($dteResponse['status'] === 'error') {
            $dteStatus = array(
                "status" => "error",
                "message" => "Error: {$dteResponse['error']}\n File: {$dteResponse['file']}\n Line: {$dteResponse['line']}",
            );

            // add dye and paths with nulls
            $dteResponse['dte'] = null; 
            $dteResponse['paths'] = null;
        }
        else
            $dteStatus = array(
                "status" => "success",
                "message" => $dteResponse['message'],
            );    
        
        $crudSlSaleCreditNote = new CrudSlSaleCreditNoteService(
            $serviceOrder, 
            $sale, 
            $dteResponse['dte'], 
            $dteResponse['paths']
        );
        $resp = $crudSlSaleCreditNote->store();

        $serviceOrder->sl_sale_credit_note_id = $resp['dte']->id;
        $serviceOrder->save();

        return CustomResponse::ok(array_merge($resp, [
            'sale_id' => $sale->id,
            'service_order_id' => $serviceOrder->id,
            'service_order_created_at' => $serviceOrder->created_at,
            'sl_sale_credit_note' => $resp['dte'],
            'dte_status' => $dteStatus,
        ]));
    }

    /**
     * Sale can be cancelled only it was paid
     *
     * @param PosSale $sale
     * @return void
     */
    private function checkIfSaleCanBeCancelled(PosSale $sale)
    {
        if ( $sale->g_state_id !== SaleConstant::SALE_STATE_REALIZADA ) {
            throw new ValidationException("No se puede anular una venta no pagada");
        }
    }

    /**
     * Return a new service order
     *
     * @param CancelServiceOrderRequest $request
     * @param int $ticketId
     * @param int $invoiceId
     * @return SlServiceOrder
     */
    public function newServiceOrder(CancelServiceOrderRequest $request, $ticketId, $invoiceId)
    {
        return new SlServiceOrder([
            'g_seller_user_id' => $request->seller_user_id,
            'g_supervisor_user_id' => $request->supervisor_user_id,
            'sl_sale_ticket_id' => $ticketId,
            'sl_sale_invoice_id' => $invoiceId,
            'sl_sale_ticket_id2' => null,
            'sl_sale_invoice_id2' => null,
            'comment' => $request->comment ? $request->comment : '',
            'sl_service_order_type_id' => ServiceOrderConstant::SERVICE_ORDER_TYPE_CANCEL,
            'flag_delete' => false
        ]);
    }

}
