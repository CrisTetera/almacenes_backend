<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_orderer_id
 * @property int $wh_product_id
 * @property string provider_product_code
 * @property float quantity
 * @property string brand
 * @property string description
 * @property boolean $flag_delete
 * @property WhOrderer $whOrderer
 * @property WhProduct $whProduct
 */
class WhDetailOrderer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_detail_orderer';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_orderer_id',
        'wh_product_id',
        'provider_product_code',
        'quantity',
        'brand',
        'description',
        'flag_delete'
    ];

    protected $attributes = [
        'flag_delete' => false
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whOrderer()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhOrderer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }

}
