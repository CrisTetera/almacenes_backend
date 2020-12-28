<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property float $sl_sale_debit_note_id
 * @property int $wh_product_id
 * @property float $quantity
 * @property float $discount_or_charge
 * @property float $subtotal
 * @property boolean $flag_delete
 * @property WhProduct $whProduct
 * @property SlSaleDebitNote $slSaleDebitNote
 */
class SlDetailSaleDebitNote extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_detail_sale_debit_note';

    /**
     * @var array
     */
    protected $fillable = ['sl_sale_debit_note_id', 'wh_product_id', 'quantity', 'discount_or_charge', 'subtotal', 'flag_delete'];



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
    public function slSaleDebitNote()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleDebitNote');
    }
}
