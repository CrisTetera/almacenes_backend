<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_user_id
 * @property string $action
 * @property GUser $gUser
 */
class AuditSystemLogs extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['g_user_id', 'action'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser');
    }
}
