<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property boolean $flag_delete
 * @property WhWarehouse[] $whWarehouses
 */
class WhWarehouseType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_warehouse_type';

    /**
     * @var array
     */
    protected $fillable = ['type', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whWarehouses()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhWarehouse');
    }
}
