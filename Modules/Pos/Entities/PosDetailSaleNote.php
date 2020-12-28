<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pos_sale_note_id
 * @property float $discount_or_charge
 * @property float $subtotal
 * @property boolean $flag_delete
 * @property PosSaleNote $posSaleNote
 */
class PosDetailSaleNote extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_detail_sale_note';

    /**
     * @var array
     */
    protected $fillable = ['pos_sale_note_id', 'discount_or_charge', 'subtotal', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSaleNote()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSaleNote');
    }
}
