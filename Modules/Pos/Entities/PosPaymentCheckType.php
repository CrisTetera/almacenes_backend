<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property boolean $flag_delete
 */
class PosPaymentCheckType extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_payment_check_type';

    /**
     * @var array
     */
    protected $fillable = [
        'type'
    ];

}
