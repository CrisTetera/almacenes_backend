<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_user_id
 * @property int $pos_sale_id
 * @property float $subtotal
 * @property float $discount_or_charge
 * @property float $new_subtotal
 * @property float $iva
 * @property float $total
 * @property boolean $flag_delete
 * @property GUser $gUser
 * @property PosSale $posSale
 * @property PosSale[] $posSales
 * @property WhDetailSaleNote[] $whDetailSaleNotes
 */
class WhSaleNote extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_sale_note';

    /**
     * @var array
     */
    protected $fillable = ['g_user_id', 'pos_sale_id', 'subtotal', 'discount_or_charge', 'new_subtotal', 'iva', 'total', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser');
    }

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
    public function whDetailSaleNotes()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailSaleNote');
    }
}
