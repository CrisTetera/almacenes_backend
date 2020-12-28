<?php

namespace Modules\Warehouse\Services\WhWarehouse;

use Modules\Warehouse\Http\Requests\WhWarehouse\CreateWarehouseRequest;
use Modules\Warehouse\Entities\WhWarehouse;
use Modules\Warehouse\Http\Requests\WhWarehouse\EditWarehouseRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\Transform;

class WarehouseService
{
    public function store(CreateWarehouseRequest $request) : int
    {
        $warehouse = new WhWarehouse();
        $requestData = $request->only( $warehouse->getFillable() );
        $warehouseData = Transform::transformNullsToEmptyString($requestData);
        $warehouse->fill($warehouseData)->save();

        return $warehouse->id;
    }

    public function update(int $idWarehouse, EditWarehouseRequest $request) : void
    {
        $warehouse = $this->checkWarehouse($idWarehouse);
        $requestData = $request->only( $warehouse->getFillable() );
        $warehouseData = Transform::transformNullsToEmptyString($requestData);
        $warehouse->fill($warehouseData)->save();
    }

    public function delete(int $idWarehouse) : void
    {
        $warehouse = $this->checkWarehouse($idWarehouse);
        $this->deleteWarehouse($warehouse);
    }

    private function deleteWarehouse(WhWarehouse $warehouse)
    {
        $warehouse->update(['flag_delete' => true]);
    }

    public function checkWarehouse(int $idWarehouse) : WhWarehouse
    {
        $warehouse = WhWarehouse::whereId($idWarehouse)->whereFlagDelete(false)->first();
        if (!$warehouse)
        {
            throw new ModelNotFoundException("Bodega ($idWarehouse) no encontrada");
        }
        return $warehouse;
    }
}
