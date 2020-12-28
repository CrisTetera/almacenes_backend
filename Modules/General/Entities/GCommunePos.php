<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

class GCommunePos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_commune_pos';

    protected $fillable = [
        'name',
        'g_province_id',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gProvincePos()
    {
        return $this->belongsTo('Modules\General\Entities\GProvincePos');
    }
}
