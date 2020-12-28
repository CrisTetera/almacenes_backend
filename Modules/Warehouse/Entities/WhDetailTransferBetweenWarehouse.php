<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_transfer_between_warehouse_id
 * @property int $wh_product_id
 * @property float $quantity
 * @property int $state
 * @property boolean $flag_delete
 * @property WhProduct $whProduct
 * @property WhTransferBetweenWarehouse $whTransferBetweenWarehouse
 */
class WhDetailTransferBetweenWarehouse extends Model
{

    public const PENDING        = 0;
    public const RECEIVED       = 1;
    public const NOT_RECEIVED   = -1;

    public const STATES = [ self::PENDING, self::RECEIVED, self::NOT_RECEIVED ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_detail_transfer_between_warehouse';

    protected $appends = ['status'];

    /**
     * @var array
     */
    protected $fillable = [
        'wh_transfer_between_warehouse_id',
        'wh_product_id',
        'quantity',
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
    public function whTransferBetweenWarehouse()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhTransferBetweenWarehouse');
    }

    public function getStatusAttribute()
    {
        switch($this->state)
        {
            case self::PENDING:      return 'Pendiente';    break;
            case self::RECEIVED:     return 'Recibido';     break;
            case self::NOT_RECEIVED: return 'No Recibido';  break;
            default: return 'Sin Estado';
        }
    }

    public function markAsPending()
    {
        $this->state = self::PENDING;
    }

    public function markAsReceived()
    {
        $this->state = self::RECEIVED;
    }

    public function markAsNotReceived()
    {
        $this->state = self::NOT_RECEIVED;
    }
}
