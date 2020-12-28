<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $origin_sale
 * @property boolean $flag_delete
 * @property string $created_at
 * @property string $updated_at
 * @property PosSale[] $posSales
 */
class PosOriginSale extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_origin_sale';

    /**
     * @var array
     */
    protected $fillable = ['origin_sale', 'flag_delete', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSale');
    }
}
