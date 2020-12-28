<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

class SlSchemeDiscountPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_scheme_discount_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_product_id',
        'quantity_discount',
        'percentage_discount',
        'unit_price_discount',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
