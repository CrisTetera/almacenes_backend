<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

class GProvincePos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_province_pos';

    protected $fillable = [
        'name',
        'g_region_id',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gRegionPos()
    {
        return $this->belongsTo('Modules\General\Entities\GRegionPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gCommunesPos()
    {
        return $this->hasMany('Modules\General\Entities\GCommunePos');
    }
}
