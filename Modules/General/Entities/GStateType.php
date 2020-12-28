<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $state_type
 * @property GState[] $gStates
 */
class GStateType extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_state_type';

    /**
     * @var array
     */
    protected $fillable = ['state_type'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gStates()
    {
        return $this->hasMany('Modules\General\Entities\GState');
    }
}
