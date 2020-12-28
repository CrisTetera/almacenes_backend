<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property GMenu[] $gMenus
 */
class GModule extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_module';

    /**
     * @var array
     */
    protected $appends = ['absolute_bg_url_module'];

    /**
     * @var array
     */
    protected $fillable = ['name', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gMenus()
    {
        return $this->hasMany('Modules\General\Entities\GMenu');
    }

    /**
     * Get Absolute URL of url_bg_module
     * @return string
     */
    public function getAbsoluteBgUrlModuleAttribute()
    {
        return url($this->url_bg_module);
    }
}
