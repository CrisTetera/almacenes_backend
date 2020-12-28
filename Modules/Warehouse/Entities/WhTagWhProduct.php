<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $wh_product_id
 * @property int $wh_tag_id
 * @property WhTag $whTag
 * @property WhProduct $whProduct
 */
class WhTagWhProduct extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_tag_wh_product';

    /**
     * @var array
     */
    protected $fillable = [];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whTag()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhTag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
