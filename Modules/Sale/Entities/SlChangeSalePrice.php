<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_product_id
 * @property float $old_sale_price
 * @property float $new_sale_price
 * @property boolean $flag_delete
 * @property WhProduct $whProduct
 */
class SlChangeSalePrice extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_change_sale_price';

    /**
     * @var array
     */
    protected $fillable = ['wh_product_id', 'old_sale_price', 'new_sale_price', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
