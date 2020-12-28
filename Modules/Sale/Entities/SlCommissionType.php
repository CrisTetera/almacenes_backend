<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $type
 * @property string $description
 * @property boolean $flag_delete
 * @property string $created_at
 * @property string $updated_at
 */
class SlCommissionType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_commission_type';

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'description'
    ];
}
