<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Esta tabla representa el "Motivo" de Algún stock de movimiento.
 *
 * @property int $id
 * @property string $reason
 * @property boolean $flag_delete
 * @property WhStockMovement[] $whStockMovements
 */
class WhWarehouseMovement extends Model
{

    public const TRANSFER_BETWEEN_WAREHOUSE = 1;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_warehouse_movement';

    /**
     * @var array
     */
    protected $fillable = ['flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whStockMovements()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhStockMovement');
    }
}
