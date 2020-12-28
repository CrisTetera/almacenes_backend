<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

class PosDetailPos extends Model
{
    // Consatant
    private const POS_SALE_BOLETA = 1;
    private const POS_SALE_FACTURA = 2;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_detail_pos';

    protected $fillable = [
        'line_number',
        'wh_warehouse_id',
        'wh_product_id',
        'pos_sale_id',
        'quantity',
        'price',
        'net_price',
        'net_subtotal',
        'discount_percentage',
        'discount_amount',
        'new_net_subtotal',
        'total',
        'flag_delete'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSalePos()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSalePos' , 'pos_sale_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whWarehousePos()
    {
        return $this->belongsTo('Modules\Pos\Entities\WhWarehousePos','wh_warehouse_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProductPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProductPos', 'wh_product_id');
    }

    // FIXME: add comments
    public function discountPercentage()
    {
        if($this->posSalePos->pos_sale_type_id == self::POS_SALE_BOLETA)
            return $this->discountPercetageBoleta();
        else // if self::POS_SALE_FACTURA
            return $this->discountPercetageFactura();
    } // edn function

    // FIXME: add comments
    private function discountPercetageBoleta()
    {
        if($this->discount_percentage > 0)
            return $this->discount_percentage;
        else if ($this->discount_amount > 0)
            return round(
                            ($this->total*100) /
                            ($this->price * $this->quantity)
                    , 2); // 2 => decimal precition
        else //pos sale without discount
            return 0;
    } // end function

    // FIXME: add comments
    private function discountPercetageFactura()
    {
        if($this->discount_percentage > 0)
            return round($this->discount_percentage, 2);
        else if ($this->discount_amount > 0)
            return round(
                            ($this->new_net_subtotal * 100) /
                            ($this->net_subtotal)
                    , 2); // 2 => decimal precition
        else //pos sale without discount
            return 0;
    } // end function

    // FIXME: add comments
    public function discountAmount()
    {
        if($this->posSalePos->pos_sale_type_id == self::POS_SALE_BOLETA)
            return $this->discountAmountBoleta();
        else // if self::POS_SALE_FACTURA
            return $this->discountAmountFactura();
    } // edn function


    // FIXME: add comments
    public function discountAmountBoleta()
    {
        if($this->discount_amount > 0)
            return $this->discount_amount;
        else if ($this->discount_percentage > 0)
            return ( $this->quantity * $this->price) - $this->total;
        else //pos sale without discount
            return 0;
    } // edn function


    // FIXME: add comments
    public function discountAmountFactura()
    {
        if($this->discount_amount > 0)
            return round( $this->discount_amount / 1.19 );
        else if ($this->discount_percentage > 0)
            return ( $this->quantity * $this->net_price) - $this->new_net_subtotal;
        else //pos sale without discount
            return 0;
    } // edn function

}
