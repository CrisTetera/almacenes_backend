<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property PosSalePos[] $posSales
 */
class PosSaleTypePos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_sale_type_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSalesPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSalePos','pos_sale_type_id');
    }
}
