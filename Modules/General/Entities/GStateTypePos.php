<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

class GStateTypePos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_state_type_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'state_type',
        'flag_delete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gStatesPos()
    {
        return $this->hasMany('Modules\General\Entities\GStatePos');
    }
}
