<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_warehouse_id
 * @property int $wh_product_id
 * @property int $discount_or_charge
 * @property int quantity
 * @property int price
 * @property int net_price
 * @property int net_subtotal
 * @property int discount_or_charge_percentage
 * @property int discount_or_charge_value
 * @property int new_net_subtotal
 * @property int total
 * @property boolean $flag_delete
 * @property PosSale $posSale
 * @property WhProduct $whProduct
 */
class PosDetailSale extends Model
{
    // Consatant
    private const POS_SALE_BOLETA = 1;
    private const POS_SALE_FACTURA = 2;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_detail_sale';

    /**
     * @var array
     */
    protected $fillable = [
                            'line_number',
                            'wh_warehouse_id',
                            'wh_product_id',
                            'pos_sale_id',
                            'discount_or_charge',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSale()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whWarehouse()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehouse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }

    // FIXME: add comments
    public function discountOrChargePercentage()
    {
        if($this->posSale->pos_sale_type_id == self::POS_SALE_BOLETA)
            return $this->discountOrChargePercetageBoleta();
        else // if self::POS_SALE_FACTURA
            return $this->discountOrChargePercetageFactura();
    } // edn function

    // FIXME: add comments
    private function discountOrChargePercetageBoleta()
    {
        if($this->discount_or_charge_percentage > 0)
            return $this->discount_or_charge_percentage;
        else if ($this->discount_or_charge_value > 0)
            return round(
                            ($this->total*100) /
                            ($this->price * $this->quantity)
                    , 2); // 2 => decimal precition
        else //pos sale without discount
            return 0;
    } // end function

    // FIXME: add comments
    private function discountOrChargePercetageFactura()
    {
        if($this->discount_or_charge_percentage > 0)
            return round($this->discount_or_charge_percentage, 2);
        else if ($this->discount_or_charge_value > 0)
            return round(
                            ($this->new_net_subtotal * 100) /
                            ($this->net_subtotal)
                    , 2); // 2 => decimal precition
        else //pos sale without discount
            return 0;
    } // end function


    // FIXME: add comments
    public function discountOrChargeValue()
    {
        if($this->posSale->pos_sale_type_id == self::POS_SALE_BOLETA)
            return $this->discountOrChargeValueBoleta();
        else // if self::POS_SALE_FACTURA
            return $this->discountOrChargeValueFactura();
    } // edn function


    // FIXME: add comments
    public function discountOrChargeValueBoleta()
    {
        if($this->discount_or_charge_value > 0)
            return $this->discount_or_charge_value;
        else if ($this->discount_or_charge_percentage > 0)
            return ( $this->quantity * $this->price) - $this->total;
        else //pos sale without discount
            return 0;
    } // edn function


    // FIXME: add comments
    public function discountOrChargeValueFactura()
    {
        if($this->discount_or_charge_value > 0)
            return round( $this->discount_or_charge_value / 1.19 );
        else if ($this->discount_or_charge_percentage > 0)
            return ( $this->quantity * $this->net_price) - $this->new_net_subtotal;
        else //pos sale without discount
            return 0;
    } // edn function
}
