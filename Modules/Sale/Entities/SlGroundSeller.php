<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $hr_employee_id
 * @property boolean $flag_delete
 * @property HrEmployee $hrEmployee
 */
class SlGroundSeller extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_ground_seller';

    /**
     * @var array
     */
    protected $fillable = [
        'hr_employee_id',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hrEmployee()
    {
        return $this->belongsTo('Modules\HR\Entities\HrEmployee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customers()
    {
        return $this->belongsToMany('Modules\Sale\Entities\SlCustomerGroundSeller', 'sl_customer_ground_seller',
                                    'sl_ground_seller_id', 'sl_customer_id');
    }

}
