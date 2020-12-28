<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_product_id
 * @property boolean $flag_delete
 * @property WhProduct $whProduct
 * @property WhProduct[] $whProducts
 */
class WhPromo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_promo';

    /**
     * @var array
     */
    protected $fillable = ['wh_product_id', 'flag_delete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function whProductsPromo()
    {
        return $this->belongsToMany('Modules\Warehouse\Entities\WhProduct',
                                    'wh_promo_wh_product_promo',
                                    'wh_promo_id',
                                    'wh_product_id')
                    ->withPivot('quantity');
    }



}
