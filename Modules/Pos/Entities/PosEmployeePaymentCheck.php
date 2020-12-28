<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pos_employee_sale_payment_type_id
 * @property int $pos_employee_sale_id
 * @property int $pos_payment_check_type_id
 * @property integer $g_bank_id
 * @property string $serial_number
 * @property integer $account_number
 * @property integer $plaza
 * @property int $amount
 * @property string $emission_date
 * @property string $charge_date
 * @property boolean $flag_delete
 * @property PosEmployeeSalePaymentType $posEmployeeSalePaymentType
 */
class PosEmployeePaymentCheck extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_employee_payment_check';

    /**
     * @var array
     */
    protected $fillable = [
        'pos_employee_sale_payment_type_id',
        'pos_employee_sale_id',
        'pos_payment_check_type_id',
        'g_bank_id',
        'serial_number',
        'account_number',
        'plaza',
        'amount',
        'emission_date',
        'charge_date',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posEmployeeSalePaymentType()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosEmployeeSalePaymentType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gBank()
    {
        return $this->belongsTo('Modules\General\Entities\GBank');
    }

}
