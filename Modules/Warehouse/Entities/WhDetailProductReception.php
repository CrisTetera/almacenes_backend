<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_product_reception_id
 * @property int $wh_product_id
 * @property float $quantity
 * @property boolean $complete_reception
 * @property boolean $flag_delete
 * @property WhProduct $whProduct
 * @property WhProductReception $whProductReception
 */
class WhDetailProductReception extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_detail_product_reception';

    /**
     * @var array
     */
    protected $fillable = ['wh_product_reception_id', 'wh_product_id', 'quantity', 'complete_reception', 'flag_delete'];



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
    public function whProductReception()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProductReception');
    }
}
