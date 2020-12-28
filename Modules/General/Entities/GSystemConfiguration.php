<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 */
class GSystemConfiguration extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_system_configuration';

    /**
     * @var array
     */
    protected $fillable = [];



}
