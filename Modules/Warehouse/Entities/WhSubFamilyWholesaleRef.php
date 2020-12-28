<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $wh_subfamily_id
 * @property integer $g_branch_office_id
 * @property integer $sl_wholesale_ref_id
 * @property WhSubfamily $whSubfamily
 * @property GBranchOffice $gBranchOffice
 * @property SlWholesaleRef $slWholesaleRef
 */
class WhSubFamilyWholesaleRef extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_subfamily_wholesale_ref';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_subfamily_id',
        'g_branch_office_id',
        'sl_wholesale_ref_id'
     ];


    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whSubfamily()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhSubfamily');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gBranchOffice()
    {
        return $this->belongsTo('Modules\General\Entities\GBranchOffice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slWholesaleRef()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlWholesaleRef');
    }
}
