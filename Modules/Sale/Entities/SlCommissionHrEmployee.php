<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $sl_commission_id
 * @property integer $hr_employee_id
 * @property SlCommission $slCommission
 * @property HrEmployee $hrEmployee
 */
class SlCommissionHrEmployee extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_commission_hr_employee';

    /**
     * @var array
     */
    protected $fillable = [
        'sl_commission_id',
        'hr_employee_id'
     ];


    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCommission()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCommission');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hrEmployee()
    {
        return $this->belongsTo('Modules\HR\Entities\HrEmployee');
    }
}
