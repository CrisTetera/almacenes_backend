<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_purchase_debit_note_id
 * @property int $wh_product_id
 * @property float $quantity
 * @property string $detail
 * @property float $discount_or_charge
 * @property float $subtotal
 * @property boolean $flag_delete
 * @property PchPurchaseDebitNote $pchPurchaseDebitNote
 * @property WhProduct $whProduct
 */
class PchDetailPurchaseDebitNote extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_detail_purchase_debit_note';

    /**
     * @var array
     */
    protected $fillable = ['pch_purchase_debit_note_id', 'wh_product_id', 'quantity', 'detail', 'discount_or_charge', 'subtotal', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchPurchaseDebitNote()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchPurchaseDebitNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
