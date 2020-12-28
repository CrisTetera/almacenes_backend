<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_module_id
 * @property string $name
 * @property int $priority
 * @property string $icon
 * @property string $route
 * @property string $created_at
 * @property string $updated_at
 * @property GModulePos $gModule
 * @property GSubmenuPos[] $gSubmenus
 */
class GMenuPos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_menu_pos';

    /**
     * @var array
     */
    protected $fillable = ['g_module_id', 'name', 'priority', 'icon', 'route', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gModulePos()
    {
        return $this->belongsTo('Modules\General\Entities\GModulePos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gSubmenusPos()
    {
        return $this->hasMany('Modules\General\Entities\GSubmenuPos' , 'g_menu_id');
    }
}
