<?php

namespace Modules\Warehouse\Services\WhTransferBetweenWarehouse;

use Modules\Warehouse\Entities\WhTransferBetweenWarehouseState;
use Modules\Warehouse\Entities\WhTransferBetweenWarehouse;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Entities\WhDetailTransferBetweenWarehouse;
use Modules\Warehouse\Entities\WhProduct;
use Modules\Warehouse\Http\Requests\WhTransferBetweenWarehouse\ReceiveTransferRequest;
use Modules\Warehouse\Services\WhProduct\CrudWhProductService;
use Modules\Warehouse\Services\WhStockMovement\StockMovementService;
use Modules\Warehouse\Services\WhWarehouse\WarehouseService;
use Modules\Warehouse\Services\WhWarehouse\InOutWarehouseService;

class ReceptionService
{
    /** @var CrudTransferBetweenWarehouseService $crudTransferBetweenWarehouseService */
    private $crudTransferBetweenWarehouseService;
    /** @var CrudWhProductService $crudWhProductService */
    private $crudWhProductService;
    /** @var StockMovementService $stockMovementService */
    private $stockMovementService;
    /** @var WarehouseService $warehouseService */
    private $warehouseService;
    /** @var InOutWarehouseService $inOutWarehouseService */
    private $inOutWarehouseService;

    public function __construct(
        CrudTransferBetweenWarehouseService $crudTransferBetweenWarehouseService,
        CrudWhProductService $crudWhProductService,
        StockMovementService $stockMovementService,
        WarehouseService $warehouseService,
        InOutWarehouseService $inOutWarehouseService
    )
    {
        $this->crudTransferBetweenWarehouseService = $crudTransferBetweenWarehouseService;
        $this->crudWhProductService = $crudWhProductService;
        $this->stockMovementService = $stockMovementService;
        $this->warehouseService = $warehouseService;
        $this->inOutWarehouseService = $inOutWarehouseService;
    }

    public function receive(int $idTransfer, ReceiveTransferRequest $request)
    {
        $transfer = $this->crudTransferBetweenWarehouseService->checkTransfer($idTransfer);
        $this->checkIfCanBeReceived($transfer);
        // TODO: Chequear rol y privilegio del usuario, por ahora erá el '1'
        $transfer->g_to_supervisor_id = 1;
        $transfer->description = $request->description ? $request->description : '';
        $this->receiveProducts($transfer, $request->details);
        $transfer->hasPendingProducts() ? $transfer->markAsPartialReceived() : $transfer->markAsReceived();
        $transfer->save();
    }

    private function receiveProducts(WhTransferBetweenWarehouse $transfer, array $details)
    {
        foreach($details as $detail) // $detail --> [wh_product_id, state]
        {
            $product = $this->crudWhProductService->checkProduct($detail['wh_product_id']);

            $newState = $detail['state'];
            $detailTransfer = $this->checkDetailTransfer($transfer, $product, $newState);
            $this->checkState($detailTransfer, $product, $newState);

            if ($this->hasToIncreaseWarehouse($detailTransfer->state, $newState))
            {
                $warehouse = $this->warehouseService->checkWarehouse($transfer->wh_to_warehouse_id);
                $this->inOutWarehouseService->in($warehouse, $product, $detailTransfer->quantity);
                $this->stockMovementService->inStoreTransferMovement($warehouse, $product, $detailTransfer->quantity);
            }

            $detailTransfer->state = $newState;
            $detailTransfer->save();
        }
    }

    private function hasToIncreaseWarehouse(int $oldState, int $newState) : bool
    {
        return $oldState !== $newState && $newState === WhDetailTransferBetweenWarehouse::RECEIVED;
    }

    private function checkState(WhDetailTransferBetweenWarehouse $detailTransfer, WhProduct $product, int $state)
    {
        if ($detailTransfer->state !== WhDetailTransferBetweenWarehouse::PENDING && $detailTransfer->state !== $state)
        {
            throw new ValidationException("El producto '($product->name)' ya se ha marcado como recibido o no recibido");
        }
    }

    private function checkDetailTransfer(WhTransferBetweenWarehouse $transfer, WhProduct $product, int $state) : WhDetailTransferBetweenWarehouse
    {
        $detailTransfer = WhDetailTransferBetweenWarehouse::whereWhTransferBetweenWarehouseId($transfer->id)
                                                            ->whereWhProductId($product->id)
                                                            ->whereFlagDelete(0)
                                                            ->first();
        if (!$detailTransfer)
        {
            throw new ValidationException("El producto '($product->name)' no está asociado a esta transferencia entre bodegas");
        }
        return $detailTransfer;
    }

    private function checkIfCanBeReceived(WhTransferBetweenWarehouse $transfer)
    {
        if ($transfer->wh_transfer_between_warehouse_state_id !== WhTransferBetweenWarehouseState::DISPATCHED)
        {
            throw new ValidationException("No se puede recibir una Guía de Intercambio no despachada.");
        }
    }
}
