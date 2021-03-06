<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_sale_credit_note_id
 * @property int $wh_product_id
 * @property float $quantity
 * @property float $discount_or_charge
 * @property float $subtotal
 * @property boolean $flag_delete
 * @property WhProduct $whProduct
 * @property SlSaleCreditNote $slSaleCreditNote
 */
class SlDetailSaleCreditNote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_detail_sale_credit_note';

    /**
     * @var array
     */
    protected $fillable = [
        'sl_sale_credit_note_id',
        'line_number',
        'wh_product_id',
        'quantity',
        'net_price',
        'price',
        'discount_or_charge_percentage',
        'discount_or_charge_value',
        'subtotal',
        'flag_delete'
    ];



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
    public function slSaleCreditNote()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleCreditNote');
    }
}
