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
 * @property GModule $gModule
 * @property GSubmenu[] $gSubmenus
 */
class GMenu extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_menu';

    /**
     * @var array
     */
    protected $fillable = ['g_module_id', 'name', 'priority', 'icon', 'route', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gModule()
    {
        return $this->belongsTo('Modules\General\Entities\GModule');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gSubmenus()
    {
        return $this->hasMany('Modules\General\Entities\GSubmenu');
    }
}
