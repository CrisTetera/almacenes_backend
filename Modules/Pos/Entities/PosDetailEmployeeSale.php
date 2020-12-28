<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_product_id
 * @property int $pos_employee_sale_id
 * @property int quantity
 * @property int price
 * @property int net_price
 * @property int net_subtotal
 * @property int discount_or_charge_percentage
 * @property int discount_or_charge_value
 * @property int new_net_subtotal
 * @property int total
 * @property boolean $flag_delete
 * @property PosEmployeeSale $posEmployeeSale
 * @property WhProduct $whProduct
 */
class PosDetailEmployeeSale extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_detail_employee_sale';

    /**
     * @var array
     */
    protected $fillable = [
        'pos_employee_sale_id',
        'wh_product_id',
        'line_number',
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
    public function posEmployeeSale()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosEmployeeSale');
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
        return $this->discountOrChargePercetageBoleta();
    } // edn function

    // FIXME: add comments
    private function discountOrChargePercetageBoleta()
    {
        if($this->discount_or_charge_percentage > 0)
            return $this->discount_or_charge_percentage;
        else if ($this->discount_or_charge_value > 0)
            return round(
                            $this->discount_or_charge_value * 100 /
                            ($this->price * $this->quantity)
                    , 2); // 2 => decimal precition
        else //pos sale without discount
            return 0;
    } // end function

    // FIXME: add comments
    public function discountOrChargeValue()
    {
        return $this->discountOrChargeValueBoleta();
    } // edn function


    // FIXME: add comments
    public function discountOrChargeValueBoleta()
    {
        if($this->discount_or_charge_value > 0)
            return $this->discount_or_charge_value;
        else if ($this->discount_or_charge_percentage > 0)
            return (int) round( ($this->discount_or_charge_percentage / 100) * ($this->price * $this->quantity));
        else //pos sale without discount
            return 0;
    } // edn function


}
