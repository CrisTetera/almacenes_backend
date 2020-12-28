<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property string $token
 * @property string $created_at
 */
class PasswordResets extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'password_resets';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'email';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * @var array
     */
    protected $fillable = ['email', 'token', 'created_at'];

}
