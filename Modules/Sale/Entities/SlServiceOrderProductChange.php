<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @param int $sl_service_order_id
 * @param int $wh_product_id
 * @param int $quantity
 * @param string $movement_type
 * @param boolean $flag_delete
 */
class SlServiceOrderProductChange extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_service_order_product_change';

    /**
     * @var array
     */
    protected $fillable = [
        'sl_service_order_id',
        'wh_product_id',
        'quantity',
        'movement_type',
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
    public function slServiceOrder()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\SlServiceOrder');
    }

}
