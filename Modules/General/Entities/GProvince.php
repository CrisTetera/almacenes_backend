<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_region_id
 * @property GRegion $gRegion
 * @property GCommune[] $gCommunes
 */
class GProvince extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_province';

    /**
     * @var array
     */
    protected $fillable = ['g_region_id', 'name'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gRegion()
    {
        return $this->belongsTo('Modules\General\Entities\GRegion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gCommunes()
    {
        return $this->hasMany('Modules\General\Entities\GCommune');
    }
}
