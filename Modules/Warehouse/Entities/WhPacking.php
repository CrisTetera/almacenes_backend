<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_product_id
 * @property int $wh_product_content_id
 * @property int $quanty_product
 * @property boolean $flag_delete
 * @property WhProduct $whProduct
 * @property WhProduct[] $whProducts
 */
class WhPacking extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_packing';

    /**
     * @var array
     */
    protected $fillable = ['wh_product_id', 'wh_product_content_id', 'quantity_product', 'flag_delete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct', 'wh_product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProductContent()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct', 'wh_product_content_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProductPacking()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct', 'wh_product_id');
    }
}
