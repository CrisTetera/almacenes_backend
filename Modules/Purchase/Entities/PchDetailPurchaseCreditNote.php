<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_product_id
 * @property int $pch_purchase_credit_note_id
 * @property float $quantity
 * @property string $detail
 * @property float $discount_or_charge
 * @property PchPurchaseCreditNote $pchPurchaseCreditNote
 * @property WhProduct $whProduct
 */
class PchDetailPurchaseCreditNote extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_detail_purchase_credit_note';

    /**
     * @var array
     */
    protected $fillable = ['wh_product_id', 'pch_purchase_credit_note_id', 'quantity', 'detail', 'discount_or_charge'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchPurchaseCreditNote()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchPurchaseCreditNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
