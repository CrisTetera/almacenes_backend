<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

class SlPriceListPos extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_price_list_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_product_id',
        'sale_price',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProductPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProductPos','wh_product_id');
    }

}
