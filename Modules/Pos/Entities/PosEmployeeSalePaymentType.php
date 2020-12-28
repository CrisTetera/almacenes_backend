<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property boolean $flag_delete
 * @property PosEmployeeSale[] $posEmployeeSales
 */
class PosEmployeeSalePaymentType extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_employee_sale_payment_type';

    /**
     * @var array
     */
    protected $fillable = ['type', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posEmployeeSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosEmployeeSale');
    }
}
