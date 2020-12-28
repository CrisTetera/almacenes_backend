<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $role_id
 * @property integer $role_can_create_id
 */
class GRoleCanCreateRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'g_role_can_create_role';

    protected $fillable = [
        'role_id',
        'role_can_create_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('Spatie\Permission\Models\Role');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roleCanCreate()
    {
        return $this->belongsTo('Spatie\Permission\Models\Role');
    }

}
