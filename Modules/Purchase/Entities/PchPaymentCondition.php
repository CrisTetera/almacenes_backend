<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property boolean $flag_delete
 */
class PchPaymentCondition extends Model
{

    public const DAYS_30        = 1;
    public const DAYS_60        = 2;
    public const DAYS_90        = 3;
    public const ANTICIPATED    = 4;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pch_payment_condition';

    /**
     * @var array
     */
    protected $fillable = ['type', 'flag_delete'];


}
