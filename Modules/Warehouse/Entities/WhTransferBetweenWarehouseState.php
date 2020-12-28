<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $state
 * @property boolean $flag_delete
 */
class WhTransferBetweenWarehouseState extends Model
{
    public const CREATED                = 1;
    public const DISPATCHED             = 2;
    public const PARTIAL_RECEPTION      = 3;
    public const TOTAL_RECEPTION        = 4;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_transfer_between_warehouse_state';

    /**
     * @var array
     */
    protected $fillable = [
        'state',
        'flag_delete'
    ];
}
