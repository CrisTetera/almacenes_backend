<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_purchase_order_id
 * @property int $wh_product_id
 * @property string $provider_product_code
 * @property int $quantity
 * @property float $net_price
 * @property int $net_total
 * @property boolean $flag_delete
 * @property PchPurchaseOrder $pchPurchaseOrder
 * @property WhProduct $whProduct
*/
class PchDetailPurchaseOrder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pch_detail_purchase_order';

    /**
     * @var array
     */
    protected $fillable = [
        'pch_purchase_order_id',
        'wh_product_id',
        'provider_product_code',
        'quantity',
        'net_price',
        'net_total',
        'flag_delete'
    ];

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
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
