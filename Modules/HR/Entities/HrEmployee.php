<?php

namespace Modules\HR\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Sale\Entities\SlGroundSeller;
use Modules\Sale\Entities\SlCallCenterSeller;

/**
 * @property int $id
 * @property string $rut
 * @property string $names
 * @property string $last_name1
 * @property string $last_name2
 * @property string $email
 */
class HrEmployee extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hr_employee';

    protected $fillable = [
        'rut',
        'names',
        'last_name1',
        'last_name2',
        'email'
    ];

    /**
     * Check if employee is Ground seller
     * @return bool
     */
    public function isGroundSeller()
    {
        return SlGroundSeller::where('hr_employee_id', $this->id)->where('flag_delete', 0)->count() > 0;
    }

    /**
     * Check if employee is Call Center seller
     * @return bool
     */
    public function isCallCenterSeller()
    {
        return SlCallCenterSeller::where('hr_employee_id', $this->id)->where('flag_delete', 0)->count() > 0;
    }

    /**
     * Get seller type of employee
     * @return string
     */
    public function sellerType()
    {
        if($this->isGroundSeller())
            return 'ground seller';
        else if ($this->isCallCenterSeller())
            return 'call center seller';
        else
            return 'normal seller';
    }

    /**
     * Return discount of a employee
     *
     * @return void
     */
    public function getDiscountAttribute() {
        $presetDiscount = HrEmployeePresetsDiscount::where('hr_employee_id', $this->id)->where('flag_delete', false)->first();
        if ( !$presetDiscount ) {
            return 0;
        }
        return floatval($presetDiscount['discount_percentage']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function commissions()
    {
        return $this->belongsToMany('Modules\Pos\Entities\PosSalePaymentType', 'sl_commission_hr_employee',
                                    'hr_employee_id', 'sl_commission_id');
    }

    /**
     * Get full name of HrEmployee
     * 
     * @return string fullname
     */
    public function getFullName()
    {
        return $this->names . ' ' . $this->last_name1 . ' ' . $this->last_name2;
    }

}
