<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $family
 * @property boolean $flag_delete
 * @property WhSubfamily[] $whSubfamilies
 */
class WhFamily extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_family';

    /**
     * @var array
     */
    protected $fillable = [
        'family',
        'flag_delete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whSubfamilies()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhSubfamily');
    }
}
