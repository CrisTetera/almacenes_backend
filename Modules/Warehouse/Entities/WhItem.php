<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_product_id
 * @property int $wh_unit_of_measurement_id
 * @property float $uom_quantity
 * @property boolean $is_inventoriable
 * @property boolean $have_decimal_quantity
 * @property boolean $flag_delete
 * @property WhProduct $whProduct
 * @property WhUnitOfMeasurement $whUnitOfMeasurement
 * @property WhDetailInventory[] $whDetailInventories
 * @property WhDetailStockAdjust[] $whDetailStockAdjusts
 * @property WhPack[] $whPacks
 * @property WhStockMovement[] $whStockMovements
 * @property WhProduct[] $whProducts
 * @property WhWarehouseItem[] $whWarehouseItems
 */
class WhItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_item';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_product_id',
        'wh_unit_of_measurement_id',
        'uom_quantity',
        'is_inventoriable',
        'have_decimal_quantity',
        'flag_delete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whUnitOfMeasurement()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhUnitOfMeasurement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailInventories()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailInventory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailStockAdjusts()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailStockAdjust');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whPacks()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhPack');
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
    public function whProducts()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhProduct');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whWarehouseItems()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhWarehouseItem');
    }
}
