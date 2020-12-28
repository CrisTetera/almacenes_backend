<?php

namespace Modules\Warehouse\Services\WhWarehouseType;

use Modules\Warehouse\Entities\WhWarehouseType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Warehouse\Http\Requests\WhWarehouseType\EditWarehouseTypeRequest;
use Modules\Warehouse\Http\Requests\WhWarehouseType\CreateWarehouseTypeRequest;

class WarehouseTypeService
{

    public function store(CreateWarehouseTypeRequest $request) : int
    {
        $warehouseType = new WhWarehouseType();
        $warehouseTypeData = $request->only( $warehouseType->getFillable() );
        $warehouseType->fill($warehouseTypeData)->save();

        return $warehouseType->id;
    }

    public function update(int $idWarehouseType, EditWarehouseTypeRequest $request) : void
    {
        $warehouseType = $this->checkWarehouseType($idWarehouseType);
        $warehouseTypeData = $request->only( $warehouseType->getFillable() );
        $warehouseType->fill($warehouseTypeData)->save();
    }

    public function delete(int $idWarehouseType) : void
    {
        $warehouseType = $this->checkWarehouseType($idWarehouseType);
        $this->deleteWarehouseType($warehouseType);
    }

    private function deleteWarehouseType(WhWarehouseType $warehouseType)
    {
        $warehouseType->update(['flag_delete' => true]);
    }

    private function checkWarehouseType(int $idWarehouseType)
    {
        $warehouseType = WhWarehouseType::whereId($idWarehouseType)->whereFlagDelete(false)->first();
        if (!$warehouseType)
        {
            throw new ModelNotFoundException("Tipo de Bodega ($idWarehouseType) no encontrado");
        }
        return $warehouseType;
    }

}
