<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhProductsOnPromoPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_products_on_promo_pos';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['wh_product_id', 'wh_promo_id', 'quantity'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whPromoPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhPromoPos','wh_promo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProductPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProductPos','wh_product_id');
    }
}
