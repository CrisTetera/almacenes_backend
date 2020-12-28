<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;

/**
 * @property int $id
 * @property int $sl_sale_quotation_id
 * @property int $wh_product_id
 * @property int $quantity
 * @property int $price
 * @property int $net_price
 * @property int $net_subtotal
 * @property int $discount_or_charge_percentage
 * @property int $discount_or_charge_value
 * @property int $new_net_subtotal
 * @property int $total
 * @property boolean $flag_delete
 * @property WhProduct $whProduct
 * @property SlSaleQuotation $slSaleQuotation
 */
class SlDetailSaleQuotation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_detail_sale_quotation';

    /**
     * @var array
     */
    protected $fillable = [
        'sl_sale_quotation_id',
        'wh_product_id',
        'quantity',
        'price',
        'net_price',
        'net_subtotal',
        'discount_or_charge_percentage',
        'discount_or_charge_value',
        'new_net_subtotal',
        'total',
        'flag_delete'
    ];


    /**
     * Return discount amount
     * Ex: If you sell 20 Baltilocas with cost $400, with 10% discount and 10$ line,
     * then discount amount is (20 * 400 * 10% + 10$) rounded to 0 decimals
     * If invoice, then discount amount is: (20 * 339,14 * 10% + 10/1,19) rounded 0 decimals.
     *
     * @return void
     */
    public function getDiscountAmount()
    {
        if ( $this->slSaleQuotation->isTicket() )
        {
            $discountAmountPercentage = (int) round($this->quantity * $this->price * $this->discount_or_charge_percentage/100.0);
            $discountAmountLine = (int) round($this->discount_or_charge_value);
        } else
        {
            $discountAmountPercentage = (int) round($this->quantity * $this->net_price * $this->discount_or_charge_percentage/100.0);
            $discountAmountLine = (int) round($this->discount_or_charge_value / (1 + SaleConstant::IVA));
        }
        return $discountAmountPercentage + $discountAmountLine;
    }

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
    public function slSaleQuotation()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleQuotation');
    }
}
