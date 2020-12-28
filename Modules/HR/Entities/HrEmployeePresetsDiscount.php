<?php

namespace Modules\HR\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $hr_employee_id
 * @property float $discount_percentage
 * @property boolean $flag_delete
 * @property HrEmployee $hrEmployee
 */
class HrEmployeePresetsDiscount extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hr_employee_presets_discount';

    /**
     * @var array
     */
    protected $fillable = [
        'hr_employee_id',
        'discount_percentage',
        'flag_delete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hrEmployee()
    {
        return $this->belongsTo('Modules\HR\Entities\HrEmployee');
    }
}
