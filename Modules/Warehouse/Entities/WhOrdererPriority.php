<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $priority
 * @property boolean $flag_delete
 */
class WhOrdererPriority extends Model
{

    public const HIGH   = 1;
    public const MEDIUM = 2;
    public const LOW    = 3;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_orderer_priority';

    protected $fillable = [
        'priority',
        'flag_delete'
    ];
}
