<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhPromoPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_promo_pos';

    /**
     * @var array
     */
    protected $fillable = ['wh_product_id', 'flag_delete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProductPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProductPos','wh_product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function whProductsOnPromoPos()
    {
        return $this->belongsToMany('Modules\Warehouse\Entities\WhProductPos',
                                    'wh_products_on_promo_pos',
                                    'wh_promo_id',
                                    'wh_product_id')
                    ->withPivot('quantity');
    }
}
