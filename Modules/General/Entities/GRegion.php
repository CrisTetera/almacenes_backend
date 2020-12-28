<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $iso_3166_2_cl
 * @property GProvince[] $gProvinces
 */
class GRegion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_region';

    /**
     * @var array
     */
    protected $fillable = ['iso_3166_2_cl'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gProvinces()
    {
        return $this->hasMany('Modules\General\Entities\GProvince');
    }
}
