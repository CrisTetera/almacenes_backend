<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_dispatch_guide_id
 * @property int $wh_product_id
 * @property boolean $flag_delete
 * @property WhProduct $whProduct
 * @property WhDispatchGuide $whDispatchGuide
 */
class WhDetailDispatchGuide extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_detail_dispatch_guide';

    /**
     * @var array
     */
    protected $fillable = ['wh_dispatch_guide_id', 'wh_product_id', 'flag_delete'];



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
    public function whDispatchGuide()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhDispatchGuide');
    }
}
