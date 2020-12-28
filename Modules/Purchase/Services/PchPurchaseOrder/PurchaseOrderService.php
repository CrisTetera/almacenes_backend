<?php

namespace Modules\Purchase\Services\PchPurchaseOrder;

use Modules\Purchase\Http\Requests\PchPurchaseOrder\CreatePurchaseOrderRequest;
use App\Helpers\Transform;
use Modules\Purchase\Entities\PchDetailPurchaseOrder;
use Modules\Purchase\Entities\PchPurchaseOrder;
use Modules\Purchase\Entities\PchPurchaseOrderState;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Dotenv\Exception\ValidationException;
use Modules\Purchase\Http\Requests\PchPurchaseOrder\EditPurchaseOrderRequest;

class PurchaseOrderService
{

    /**
     * Store a new Purchase Order.
     *
     * $request->details structure:
     *       'details.*.provider_product_code',
     *       'details.*.wh_product_id',
     *       'details.*.quantity',
     *       'details.*.net_price',
     *
     * @param CreateOrdererRequest $request
     * @return integer
     */
    public function store(CreatePurchaseOrderRequest $request)
    {
        $purchaseOrder = new PchPurchaseOrder();
        $purchaseOrderData = $request->only( $purchaseOrder->getFillable() );
        $purchaseOrder->fill( Transform::transformNullsToEmptyString($purchaseOrderData) );
        $purchaseOrder->pch_purchase_order_state_id = PchPurchaseOrderState::CREATED;
        $purchaseOrder->net_subtotal = $this->calculateNetTotal($request->details);
        $purchaseOrder->iva = (int) round( SaleConstant::IVA * $purchaseOrder->net_subtotal );
        $purchaseOrder->total = $purchaseOrder->net_subtotal + $purchaseOrder->iva;
        $purchaseOrder->save();

        $this->saveDetails($purchaseOrder, $request->details);
        $this->saveOrderers($purchaseOrder, $request->orderers);
        return $purchaseOrder->id;
    }

    public function update(int $idPurchaseOrder, EditPurchaseOrderRequest $request) : void
    {
        $purchaseOrder = $this->checkPurchaseOrder($idPurchaseOrder);
        $this->checkIfCanBeModified($purchaseOrder);

        $ordererData = $request->only( $purchaseOrder->getFillable() );
        $purchaseOrder->fill($ordererData);
        $purchaseOrder->net_subtotal = $this->calculateNetTotal($request->details);
        $purchaseOrder->iva = (int) round( SaleConstant::IVA * $purchaseOrder->net_subtotal );
        $purchaseOrder->total = $purchaseOrder->net_subtotal + $purchaseOrder->iva;
        $purchaseOrder->save();

        $this->deleteDetails($purchaseOrder);
        $this->saveDetails($purchaseOrder, $request->details);
        $this->saveOrderers($purchaseOrder, $request->orderers);
    }

    public function delete(int $idPurchaseOrder) : void
    {
        $purchaseOrder = $this->checkPurchaseOrder($idPurchaseOrder);
        $this->checkIfCanBeModified($purchaseOrder);

        $purchaseOrder->update(['flag_delete' => true]);
        $this->deleteDetails($purchaseOrder);
        $this->saveOrderers($purchaseOrder, []);
    }

    private function calculateNetTotal(array $details) : int
    {
        $total = 0;
        foreach($details as $detail)
        {
            $total += (int) round( $detail['quantity'] * $detail['net_price'] );
        }
        return $total;
    }

    private function saveDetails(PchPurchaseOrder $purchaseOrder, array $details) : void
    {
        foreach($details as $detail)
        {
            $detail = Transform::transformNullsToEmptyString($detail);
            $detailOrderer = new PchDetailPurchaseOrder();
            $detailOrderer->fill($detail);
            $detailOrderer->pch_purchase_order_id = $purchaseOrder->id;
            $detailOrderer->net_total = (int) round( $detail['quantity'] * $detail['net_price'] );
            $detailOrderer->save();
        }
    }

    private function saveOrderers(PchPurchaseOrder $purchaseOrder, array $orderersIds) : void
    {
        $purchaseOrder->whOrderers()->sync($orderersIds, true);
    }

    private function deleteDetails(PchPurchaseOrder $purchaseOrder)
    {
        PchDetailPurchaseOrder::wherePchPurchaseOrderId($purchaseOrder->id)->whereFlagDelete(false)->update(['flag_delete' => true]);
    }

    private function checkPurchaseOrder(int $idPurchaseOrder) : PchPurchaseOrder
    {
        $purchaseOrder = PchPurchaseOrder::whereId($idPurchaseOrder)->whereFlagDelete(false)->first();
        if (!$purchaseOrder)
        {
            throw new ModelNotFoundException("Orden de Compra ($idPurchaseOrder) no encontrada");
        }
        return $purchaseOrder;
    }

    private function checkIfCanBeModified(PchPurchaseOrder $purchaseOrder)
    {
        if (!$this->canBeModified($purchaseOrder))
        {
            throw new ValidationException("La Orden de Compra no puede ser modificada. Ya ha sido liberada.");
        }
    }

    private function canBeModified(PchPurchaseOrder $purchaseOrder) : bool
    {
        return $purchaseOrder->pch_purchase_order_state_id === PchPurchaseOrderState::CREATED;
    }

}
