<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

class GRegionPos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_region_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'iso_3166_2_cl',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gProvinces()
    {
        return $this->hasMany('Modules\General\Entities\GProvince');
    }
}
