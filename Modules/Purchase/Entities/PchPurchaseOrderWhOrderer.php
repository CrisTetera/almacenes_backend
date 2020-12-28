<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $wh_orderer_id
 * @property int $pch_purchase_order_id
 * @property PchPurchaseOrder $pchPurchaseOrder
 * @property WhOrderer $whOrderer
 */
class PchPurchaseOrderWhOrderer extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_purchase_order_wh_orderer';

    /**
     * @var array
     */
    protected $fillable = [];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchPurchaseOrder()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchPurchaseOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whOrderer()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhOrderer');
    }
}
