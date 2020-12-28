<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_sale_ticket_id
 * @property int $wh_product_id
 * @property float $quantity
 * @property float $dicount_or_charge
 * @property float $subtotal
 * @property boolean $flag_delete
 * @property WhProduct $whProduct
 * @property SlSaleTicket $slSaleTicket
 */
class SlDetailSaleTicket extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_detail_sale_ticket';

    /**
     * @var array
     */
    protected $fillable = [
        'sl_sale_ticket_id', 
        'line_number',
        'wh_product_id', 
        'quantity', 
        'price', 
        'subtotal'
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
    public function slSaleTicket()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleTicket');
    }
}
