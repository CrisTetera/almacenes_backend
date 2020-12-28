<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_menu_id
 * @property int $permissions_id
 * @property string $name
 * @property int $priority
 * @property string $icon
 * @property string $route
 * @property string $created_at
 * @property string $updated_at
 * @property GMenuPos $gMenu
 * @property Permission $permission
 */
class GSubmenuPos extends Model
{
/**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_submenu_pos';

    /**
     * @var array
     */
    protected $fillable = ['g_menu_id', 'permissions_id', 'name', 'priority', 'icon', 'route', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gMenuPos()
    {
        return $this->belongsTo('Modules\General\Entities\GMenuPos' , 'g_menu_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo('Modules\General\Entities\Permission', 'permissions_id');
    }}
