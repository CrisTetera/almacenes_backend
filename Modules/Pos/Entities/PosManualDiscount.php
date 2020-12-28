<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property float $percentage_discount
 * @property boolean $flag_delete
 * @property PosEmployeeSale[] $posEmployeeSales
 * @property PosSale[] $posSales
 */
class PosManualDiscount extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_manual_discount';

    /**
     * @var array
     */
    protected $fillable = ['percentage_discount', 'flag_delete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posEmployeeSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosEmployeeSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSale');
    }
}
