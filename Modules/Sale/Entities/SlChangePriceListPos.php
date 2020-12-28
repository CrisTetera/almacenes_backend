<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

class SlChangePriceListPos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_change_price_list_pos';

    /**
     * @var array
     */
    protected $fillable = ['wh_product_id', 'old_sale_price', 'new_sale_price', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProductPos');
    }
}
