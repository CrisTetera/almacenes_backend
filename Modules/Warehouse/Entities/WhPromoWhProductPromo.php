<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $wh_product_id
 * @property int $wh_promo_id
 * @property WhPromo $whPromo
 * @property WhProduct $whProduct
 */
class WhPromoWhProductPromo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_promo_wh_product_promo';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['wh_product_id', 'wh_promo_id'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whPromo()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhPromo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }

}
