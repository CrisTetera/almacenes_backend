<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_purchase_invoice_id
 * @property int $wh_product_id
 * @property float $discount_or_charge
 * @property PchPurchaseInvoice $pchPurchaseInvoice
 * @property WhProduct $whProduct
 */
class PchDetailPurchaseInvoice extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_detail_purchase_invoice';

    /**
     * @var array
     */
    protected $fillable = ['pch_purchase_invoice_id', 'wh_product_id', 'discount_or_charge'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchPurchaseInvoice()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchPurchaseInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
