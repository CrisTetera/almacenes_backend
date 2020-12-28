<?php

namespace Modules\Warehouse\Services\WhTransferBetweenWarehouse;

use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Entities\WhTransferBetweenWarehouseState;
use Modules\Warehouse\Entities\WhTransferBetweenWarehouse;
use Modules\Warehouse\Entities\WhDetailTransferBetweenWarehouse;
use Modules\Warehouse\Services\WhStockMovement\StockMovementService;
use Modules\Warehouse\Services\WhProduct\CrudWhProductService;
use Modules\Warehouse\Services\WhWarehouse\WarehouseService;
use Modules\Warehouse\Services\WhWarehouse\InOutWarehouseService;

class DispatchService
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

    public function dispatch(int $idTransfer)
    {
        $transfer = $this->crudTransferBetweenWarehouseService->checkTransfer($idTransfer);
        $this->checkIfCanBeDispatched($transfer);
        $transfer->markAsDispatched();
        $transfer->save();
        $this->dispatchProducts($transfer);
    }

    private function dispatchProducts(WhTransferBetweenWarehouse $transfer)
    {
        $detailTransfer = WhDetailTransferBetweenWarehouse::whereWhTransferBetweenWarehouseId($transfer->id)
                                                            ->whereFlagDelete(0)
                                                            ->get();

        $detailTransfer->each(function($detail) use (&$transfer) {
            $warehouse = $this->warehouseService->checkWarehouse($transfer->wh_from_warehouse_id);
            $product = $this->crudWhProductService->checkProduct($detail->wh_product_id);
            $this->inOutWarehouseService->out($warehouse, $product, $detail->quantity);
            $this->stockMovementService->outStoreTransferMovement($warehouse, $product, $detail->quantity);
        });
    }

    private function checkIfCanBeDispatched(WhTransferBetweenWarehouse $transfer)
    {
        if ($transfer->wh_transfer_between_warehouse_state_id !== WhTransferBetweenWarehouseState::CREATED)
        {
            throw new ValidationException("La Guía de Intercambio no se puede marcar como 'Despachada'.");
        }
    }

}
