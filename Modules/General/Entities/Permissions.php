<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property string $created_at
 * @property string $updated_at
 * @property GSubmenuPos[] $gSubmenus
 */
class Permissions extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'guard_name', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gSubmenuPos()
    {
        return $this->belongsTo('App\GSubmenuPos', 'permissions_id');
    }
}
