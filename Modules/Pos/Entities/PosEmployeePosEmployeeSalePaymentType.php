<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $pos_employee_sale_payment_type_id
 * @property int $pos_employee_sale_id
 * @property int $amount
 * @property PosEmployeeSale $posEmployeeSale
 * @property PosEmployeeSalePaymentType $posEmployeeSalePaymentType
 */
class PosEmployeePosEmployeeSalePaymentType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_employee_sale_pos_employee_sale_payment_type';

    /**
     * @var array
     */
    protected $fillable = [
        'pos_employee_sale_id',
        'pos_employee_sale_payment_type_id',
        'amount'
    ];


    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posEmployeeSale()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosEmployeeSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posEmployeeSalePaymentType()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosEmployeeSalePaymentType');
    }
}
