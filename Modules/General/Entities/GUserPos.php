<?php

namespace Modules\General\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\HR\Entities\HrEmployeePos;

class GUserPos extends Authenticatable
{

    use HasApiTokens, Notifiable, HasRoles; //Spatie Permissions
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'g_user_pos';

    protected $guard_name = 'api';
    
    protected $hidden = array('password', 'remember_token');

    protected $fillable = [
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
        return $this->hrEmployeePos->email;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hrEmployeePos()
    {
        return $this->belongsTo('Modules\HR\Entities\HrEmployeePos', 'hr_employee_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDailyCashPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDailyCashPos');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posCashDeskMovements()
    {
        return $this->hasMany('Modules\Pos\Entities\PosCashDeskMovementPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSalesPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSalePos');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whStockAdjustsPos()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhStockAdjustPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whInventoriesAsGrocer()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhInventoryPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whInventoriesAsSupervisor()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhInventoryPos', 'g_user_id2');
    }


    /**
     * Get fullname gUser
     * @return string
     */
    public function getFullName()
    {
        $employee = HrEmployeePos::where('id', $this->hr_employee_id)->first();
        return ucwords($employee->first_names . ' ' . $employee->last_name1 . ' ' . $employee->last_name2);
    } // end function
}
