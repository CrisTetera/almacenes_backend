<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_list_price_id
 * @property int $wh_product_id
 * @property float $sale_price
 * @property WhProduct $whProduct
 * @property SlListPrice $slListPrice
 */
class SlDetailListPrice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_detail_list_price';

    /**
     * @var array
     */
    protected $fillable = [
        'sl_list_price_id',
        'wh_product_id',
        'sale_price',
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
    public function slListPrice()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlListPrice');
    }
}
