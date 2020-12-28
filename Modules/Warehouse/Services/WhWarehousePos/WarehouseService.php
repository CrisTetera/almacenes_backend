<?php

namespace Modules\Warehouse\Services\WhWarehousePos;

use Modules\Warehouse\Http\Requests\WhWarehousePos\CreateWarehouseRequest;
use Modules\Warehouse\Entities\WhWarehousePos;
use Modules\Warehouse\Http\Requests\WhWarehousePos\EditWarehouseRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\Transform;

class WarehouseService
{
    public function store(CreateWarehouseRequest $request) : int
    {
        $warehouse = new WhWarehousePos();
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
        //$warehouse->update(['flag_delete' => true]);
        $this->deleteWarehouse($this->$warehouse);
        $warehouse->update(['flag_delete' => true]);
    }
    
    private function deleteWarehouse(WhWarehousePos $warehouse)
    {
        $warehouse->update(['flag_delete' => true]);
    }

    public function checkWarehouse(int $idWarehouse) : WhWarehouse
    {
        $warehouse = WhWarehousePos::whereId($idWarehouse)->whereFlagDelete(false)->first();
        if (!$warehouse)
        {
            throw new ModelNotFoundException("Bodega ($idWarehouse) no encontrada");
        }
        return $warehouse;
    }
}
