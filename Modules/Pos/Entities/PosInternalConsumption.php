<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $hr_requester_employee_id
 * @property integer $g_seller_user_id
 * @property integer $g_branch_office_id
 * @property string $description
 * @property boolean $flag_delete
 * @property PosDetailInternalConsumption[] $posDetailInternalConsumptions
 * @property GUser $gSellerUser
 * @property GBranchOffice $gBranchOffice
 */
class PosInternalConsumption extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_internal_consumption';

    /**
     * @var array
     */
    protected $fillable = [
        'description',
        'hr_requester_employee_id',
        'g_seller_user_id',
        'g_branch_office_id',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDetailInternalConsumptions()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDetailInternalConsumption');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function hrRequesterEmployee()
    {
        return $this->belongsTo('Modules\HR\Entities\HrEmployee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function gSellerUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function gBranchOffice()
    {
        return $this->belongsTo('Modules\General\Entities\GBranchOffice');
    }

}
