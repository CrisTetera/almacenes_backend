<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $code
 * @property string $core_business
 */
class GCoreBusinessSii extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'g_core_business_sii';

    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'core_business'
    ];

}
