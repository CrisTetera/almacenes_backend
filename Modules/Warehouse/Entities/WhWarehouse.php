<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_branch_office_id
 * @property int $wh_warehouse_type_id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $is_waste_warehouse
 * @property boolean $flag_delete
 * @property GBranchOffice $gBranchOffice
 * @property WhWarehouseType $whWarehouseType
 * @property WhStockAdjust[] $whStockAdjusts
 * @property WhStockMovement[] $whStockMovements
 * @property WhTransferBetweenWarehouse[] $whTransferBetweenWarehousesDestination
 * @property WhTransferBetweenWarehouse[] $whTransferBetweenWarehousesOrigin
 * @property WhWarehouseItem[] $whWarehouseItems
 * @property WhInventory[] $whInventories
 */
class WhWarehouse extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_warehouse';

    /**
     * @var array
     */
    protected $fillable = [
        'g_branch_office_id',
        'wh_warehouse_type_id',
        'name',
        'description',
        'address',
        'is_waste_warehouse',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gBranchOffice()
    {
        return $this->belongsTo('Modules\General\Entities\GBranchOffice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whWarehouseType()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehouseType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whStockAdjusts()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhStockAdjust');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whStockMovements()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhStockMovement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whTransferBetweenWarehousesDestination()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhTransferBetweenWarehouse', 'wh_warehouse_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whTransferBetweenWarehousesOrigin()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhTransferBetweenWarehouse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whWarehouseItems()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhWarehouseItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whInventories()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhInventory');
    }
}
