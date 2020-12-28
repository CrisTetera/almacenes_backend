<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhFamilyPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_family_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'family',
        'flag_delete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whSubfamilies()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhSubfamilyPos' , "wh_family_id");
    }
}
