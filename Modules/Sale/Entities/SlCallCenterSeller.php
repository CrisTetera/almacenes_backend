<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $hr_employee_id
 * @property boolean $flag_delete
 * @property string $created_at
 * @property string $updated_at
 * @property HrEmployee $hrEmployee
 */
class SlCallCenterSeller extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_call_center_seller';

    /**
     * @var array
     */
    protected $fillable = ['hr_employee_id', 'flag_delete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hrEmployee()
    {
        return $this->belongsTo('Modules\HR\Entities\HrEmployee');
    }
}
