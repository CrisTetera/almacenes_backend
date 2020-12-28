<?php

namespace Modules\Purchase\Services\PchPurchaseOrder;

use Modules\Purchase\Entities\PchPurchaseOrder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Dotenv\Exception\ValidationException;
use Modules\Purchase\Entities\PchPurchaseOrderState;

class AuthorizePurchaseOrderService
{

    public function authorize(int $idPurchaseOrder)
    {
        // TODO: Check if logged user has role 'adm_supervisor' or privilege 'autorizar orden de compra'
        $purchaseOrder = $this->checkPurchaseOrder($idPurchaseOrder);
        $this->checkIfCanBeAuthorized($purchaseOrder);
        // TODO: SET id of authorized user
        $purchaseOrder->g_authorizer_user_id = 1; // Por ahora 1
        $purchaseOrder->pch_purchase_order_state_id = PchPurchaseOrderState::AUTHORIZED;
        $purchaseOrder->save();
        // TODO: Cambiar estado a 'Pendiente a Enviar Correo'
        // TODO: Enviar mail (GeneratePDFPurchaseOrderService)
        // TODO: Si se envía, cambiar estado a 'En Trámite
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

    private function checkIfCanBeAuthorized(PchPurchaseOrder $purchaseOrder)
    {
        if (!$this->canBeAuthorized($purchaseOrder))
        {
            throw new ValidationException("La Orden de Compra ya ha sido autorizada.");
        }
    }

    private function canBeAuthorized(PchPurchaseOrder $purchaseOrder) : bool
    {
        return $purchaseOrder->pch_purchase_order_state_id === PchPurchaseOrderState::CREATED;
    }

}
