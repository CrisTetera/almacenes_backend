<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_user_id
 * @property string $module_token
 * @property string $user_token
 * @property string $created_at
 * @property string $updated_at
 * @property GUserPos $gUser
 */
class GTemporalModuleToken extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_temporal_module_token';

    /**
     * @var array
     */
    protected $fillable = ['g_user_id', 'module_token', 'user_token', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUserPos()
    {
        return $this->belongsTo('Entities\General\Entities\GUserPos');
    }
}
