<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pos_sale_id
 * @property string $number
 * @property string $emission_date
 * @property float $subtotal
 * @property float $discount_or_charge
 * @property float $new_subtotal
 * @property float $total
 * @property boolean $flag_delete
 * @property PosSale $posSale
 * @property PosSale[] $posSales
 * @property PosDetailSaleNote[] $posDetailSaleNotes
 */
class PosSaleNote extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_sale_note';

    /**
     * @var array
     */
    protected $fillable = ['pos_sale_id', 'number', 'emission_date', 'subtotal', 'discount_or_charge', 'new_subtotal', 'total', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSale()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDetailSaleNotes()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDetailSaleNote');
    }
}
