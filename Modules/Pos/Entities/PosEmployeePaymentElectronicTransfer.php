<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pos_employee_sale_payment_type_id
 * @property int $pos_employee_sale_id
 * @property int $transfer_number
 * @property boolean $flag_delete
 * @property PosEmployeeSalePaymentType $posEmployeeSalePaymentType
 * @property PosEmployeeSale $posEmployeeSale
 */
class PosEmployeePaymentElectronicTransfer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_employee_payment_electronic_transfer';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'pos_employee_sale_payment_type_id',
        'pos_employee_sale_id',
        'transfer_number',
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
    public function posEmployeeSale()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosEmployeeSale');
    }
}
