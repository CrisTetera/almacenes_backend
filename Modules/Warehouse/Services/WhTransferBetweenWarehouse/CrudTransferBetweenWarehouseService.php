<?php

namespace Modules\Warehouse\Services\WhTransferBetweenWarehouse;

use Modules\Warehouse\Http\Requests\WhTransferBetweenWarehouse\CreateTransferBetweenWarehouseRequest;
use Modules\Warehouse\Entities\WhTransferBetweenWarehouse;
use Modules\Warehouse\Entities\WhDetailTransferBetweenWarehouse;
use App\Helpers\Transform;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Http\Requests\WhTransferBetweenWarehouse\EditTransferBetweenWarehouseRequest;
use Modules\Warehouse\Entities\WhTransferBetweenWarehouseState;

class CrudTransferBetweenWarehouseService
{

    public function store(CreateTransferBetweenWarehouseRequest $request)
    {
        $transfer = new WhTransferBetweenWarehouse( );
        $transferData = Transform::transformNullsToEmptyString($request->only($transfer->getFillable()));
        $transfer->fill($transferData);
        $transfer->markAsCreated();
        $transfer->save();
        $this->saveDetails($transfer, $request->details);
        return $transfer->id;
    }

    public function update(int $idTransfer, EditTransferBetweenWarehouseRequest $request)
    {
        $transfer = $this->checkTransfer($idTransfer);
        $this->checkIfCanBeModified($transfer);
        $transferData = Transform::transformNullsToEmptyString($request->only($transfer->getFillable()));
        $transfer->fill($transferData);
        $transfer->deleteDetails();
        $transfer->save();
        $this->saveDetails($transfer, $request->details);
    }

    public function delete(int $idTransfer)
    {
        $transfer = $this->checkTransfer($idTransfer);
        $this->checkIfCanBeModified($transfer);
        $transfer->flag_delete = true;
        $transfer->deleteDetails();
        $transfer->save();
    }

    public function saveDetails(WhTransferBetweenWarehouse $transfer, array $details)
    {
        foreach($details as $detail)
        {
            $detailTransfer = new WhDetailTransferBetweenWarehouse( $detail );
            $detailTransfer->wh_transfer_between_warehouse_id = $transfer->id;
            $detailTransfer->markAsPending();
            $detailTransfer->save();
        }
    }

    public function checkTransfer(int $idTransfer) : WhTransferBetweenWarehouse
    {
        $transfer = WhTransferBetweenWarehouse::whereId($idTransfer)->whereFlagDelete(false)->first();
        if (!$transfer)
        {
            throw new ValidationException("La Guía de Intercambio ($idTransfer) no existe.");
        }
        return $transfer;
    }

    public function checkIfCanBeModified(WhTransferBetweenWarehouse $transfer)
    {
        if ($transfer->wh_transfer_between_warehouse_state_id !== WhTransferBetweenWarehouseState::CREATED)
        {
            throw new ValidationException("La Guía de Intercambio no puede ser modificada o eliminada. Ya ha sido despachada o recibida.");
        }
    }

}
