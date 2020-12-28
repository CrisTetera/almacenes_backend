<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $product_id
 * @property date $date
 * @property int $normal_sale_quantity
 * @property int $ground_sale_quantity
 * @property int $waste_quantity
 * @property int $adjust_quantity
 * @property int $purchase_quantity
 * @property WhProduct $whProduct
 */

class WhProductMovementReport extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_product_movement_report'; // virtual table (View)

    /**
     * @var array
     */
    protected $fillable = [
        'wh_product_id',
        'date',
        'normal_sale_quantity',
        'ground_sale_quantity',
        'waste_quantity',
        'adjust_quantity',
        'purchase_quantity',
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
