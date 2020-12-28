<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_dispatch_order_id
 * @property int $wh_dispatch_order_id2
 * @property int $wh_dispatch_guide_id
 * @property boolean $flag_delete
 * @property WhDispatchGuide $whDispatchGuide
 * @property WhDispatchOrder $whDispatchOrder
 */
class WhDetailDispatchOrder extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_detail_dispatch_order';

    /**
     * @var array
     */
    protected $fillable = ['wh_dispatch_order_id', 'wh_dispatch_order_id2', 'wh_dispatch_guide_id', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whDispatchGuide()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhDispatchGuide');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whDispatchOrder()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhDispatchOrder');
    }

}
