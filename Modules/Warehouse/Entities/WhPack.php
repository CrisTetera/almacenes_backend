<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_product_id
 * @property int $wh_item_id
 * @property float $item_quantity
 * @property boolean $flag_delete
 * @property WhItem $whItem
 * @property WhProduct $whProduct
 * @property WhProduct[] $whProducts
 */
class WhPack extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_pack';

    /**
     * @var array
     */
    protected $fillable = ['wh_product_id', 'wh_item_id', 'item_quantity', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whItem()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
