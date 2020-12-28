<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_purchase_order_id
 * @property boolean $flag_delete
 * @property int $number_purchase_invoice
 * @property PchPurchaseOrder $pchPurchaseOrder
 * @property PchPurchaseOrder[] $pchPurchaseOrders
 * @property WhDetailProductReception[] $whDetailProductReceptions
 */
class WhProductReception extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_product_reception';

    /**
     * @var array
     */
    protected $fillable = ['pch_purchase_order_id', 'flag_delete', 'number_purchase_invoice'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchPurchaseOrder()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchPurchaseOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchPurchaseOrders()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchPurchaseOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailProductReceptions()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailProductReception');
    }
}
