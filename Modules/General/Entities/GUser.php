<?php

namespace Modules\General\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Modules\HR\Entities\HrEmployee;
use Modules\Sale\Entities\SlGroundSeller;
use Modules\Sale\Entities\SlCommissionHrEmployee;
use Modules\HR\Entities\HrEmployeePresetsDiscount;
use Modules\Sale\Entities\SlCustomer;
use Modules\General\Notifications\ResetPasswordNotification;

/**
 * @property int $id
 * @property int $hr_employee_id
 * @property string $password
 * @property string $auth_code
 * @property string $bar_auth_code
 * @property string $remember_token
 * @property HrEmployee $hrEmployee
 * @property AuditHistoricPrice[] $auditHistoricPrices
 * @property AuditSendedEmailLog[] $auditSendedEmailLogs
 * @property AuditSystemLog[] $auditSystemLogs
 * @property PosCashMovement[] $posCashMovements
 * @property PosDailyCash[] $posDailyCashes
 * @property PosDailyCash[] $posDailyCashes
 * @property PosSale[] $posSales
 * @property WhDispatchGuide[] $whDispatchGuides
 * @property WhDispatchOrder[] $whDispatchOrders
 * @property WhOrderer[] $whOrderers
 * @property WhSaleNote[] $whSaleNotes
 * @property WhStockAdjust[] $whStockAdjusts
 * @property WhWarehouse[] $whWarehouses
 * @property WhInventory[] $whInventories
 * @property WhInventory[] $whInventories
 * @property PosEmployeeSale[] $posEmployeeSales
 * @property PosEmployeeSale[] $posEmployeeSales
 */
class GUser extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles; //Spatie Permissions

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'g_user';

    /**
     * Spatie Permission Guard Name
     */
    protected $guard_name = 'api';

    protected $hidden = array('password', 'remember_token');

    /**
     * @var array
     */
    protected $fillable = [
        // Employee has the names, last name, etc.
        'password',
        'auth_code',
        'bar_auth_code',
        'remember_token'
    ];

    /**
     * Send email reset pass notification 
     */
    public function sendPasswordResetNotification($token)
    {   
        $this->notify(new ResetPasswordNotification($token));
    } // end function

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->hrEmployee->email;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hrEmployee()
    {
        return $this->belongsTo('Modules\HR\Entities\HrEmployee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditHistoricPrices()
    {
        return $this->hasMany('Modules\General\Entities\AuditHistoricPrice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditSendedEmailLogs()
    {
        return $this->hasMany('Modules\General\Entities\AuditSendedEmailLog');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditSystemLogs()
    {
        return $this->hasMany('Modules\General\Entities\AuditSystemLog');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posCashMovements()
    {
        return $this->hasMany('Modules\Pos\Entities\PosCashMovement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDailyCashes()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDailyCash');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDailyCashesSupervisor()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDailyCash', 'g_user_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDispatchGuides()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDispatchGuide');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDispatchOrders()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDispatchOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whOrderers()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhOrderer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whSaleNotes()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhSaleNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whStockAdjusts()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhStockAdjust');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whWarehouses()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhWarehouse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whInventoriesAsGrocer()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhInventory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whInventoriesAsSupervisor()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhInventory', 'g_user_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posEmployeeSalesAsSupervisor()
    {
        return $this->hasMany('Modules\Pos\Entities\PosEmployeeSale', 'g_user_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posEmployeeSalesAsCashier()
    {
        return $this->hasMany('Modules\Pos\Entities\PosEmployeeSale');
    }

    /**
     * Get fullname gUser
     * @return string
     */
    public function getFullName()
    {
        $employee = HrEmployee::where('id', $this->hr_employee_id)->first();
        return ucwords($employee->names . ' ' . $employee->last_name1 . ' ' . $employee->last_name2);
    } // end function

    /**
     * Return if user is ground seller
     *
     * @return void
     */
    public function getIsGroundSellerAttribute()
    {
        $employee = HrEmployee::where('id', $this->hr_employee_id)->first();
        return SlGroundSeller::where('hr_employee_id', $employee->id)->where('flag_delete', false)->first() != null;
    }

     /**
     * Return user commissions
     *
     * @return void
     */
    public function getCommissionsAttribute()
    {
        $employee = HrEmployee::where('id', $this->hr_employee_id)->first();
        return SlCommissionHrEmployee::join('sl_commission', 'sl_commission_hr_employee.sl_commission_id', 'sl_commission.id')
                                    ->join('sl_commission_type', 'sl_commission.sl_commission_type_id', 'sl_commission_type.id')
                                    ->where('hr_employee_id', $employee->id)
                                    ->where('sl_commission.flag_delete', false)
                                    ->where('sl_commission_type.flag_delete', false)
                                    ->selectRaw('sl_commission.id, sl_commission.name, sl_commission.description, sl_commission.percentage, sl_commission_type.code, sl_commission_type.type')
                                    ->get();
    }

    /**
     * Return user commissions
     *
     * @return void
     */
    public function getDiscountAttribute()
    {
        $employee = HrEmployee::where('id', $this->hr_employee_id)->first();
        $presetDiscount = HrEmployeePresetsDiscount::where('hr_employee_id', $this->id)->where('flag_delete', false)->first();
        if ( !$presetDiscount ) {
            return 0;
        }
        return floatval($presetDiscount['discount_percentage']);
    }

    public function getCustomersAttribute()
    {
        return SlCustomer::with('branchOffices')
                        ->join('sl_customer_ground_seller', 'sl_customer.id', 'sl_customer_ground_seller.sl_customer_id')
                        ->join('sl_ground_seller', 'sl_customer_ground_seller.sl_ground_seller_id', 'sl_ground_seller.id')
                        ->where('sl_ground_seller.hr_employee_id', $this->hr_employee_id)
                        ->selectRaw('sl_customer.*')
                        ->get();
    }

}
