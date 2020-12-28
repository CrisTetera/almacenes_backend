<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_sale_note_id
 * @property int $wh_product_id
 * @property float $quantity
 * @property boolean $flag_delete
 * @property WhProduct $whProduct
 * @property WhSaleNote $whSaleNote
 */
class WhDetailSaleNote extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_detail_sale_note';

    /**
     * @var array
     */
    protected $fillable = ['wh_sale_note_id', 'wh_product_id', 'quantity', 'flag_delete'];



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
    public function whSaleNote()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhSaleNote');
    }
}
