<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_product_id
 * @property boolean $pos_internal_consumption_id
 * @property boolean $flag_delete
 * @property PosInternalConsumption $posInternalConsumption
 * @property WhProduct $whProduct
 */
class PosDetailInternalConsumption extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_detail_internal_consumption';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_product_id',
        'pos_internal_consumption_id',
        'quantity',
        'flag_delete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posInternalConsumption()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosInternalConsumption');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
