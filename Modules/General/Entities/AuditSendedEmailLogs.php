<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_user_id
 * @property string $email_sender
 * @property string $email_receiver
 * @property GUser $gUser
 */
class AuditSendedEmailLogs extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['g_user_id', 'email_sender', 'email_receiver'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser');
    }
}
