<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

class PosMovementTypePos extends Model
{

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_movement_type_pos';

    protected $fillable = [
        'type',
        'flag_delete'
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posCashDeskMovemetPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosCashDeskMovementPos');
    }
}
