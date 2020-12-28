<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $wh_product_id
 * @property integer $g_branch_office_id
 * @property integer $sl_wholesale_ref_id
 * @property WhProduct $whProduct
 * @property GBranchOffice $gBranchOffice
 * @property SlWholesaleRef $slWholesaleRef
 */
class WhProductWholesaleRef extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_product_wholesale_ref';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_product_id',
        'g_branch_office_id',
        'sl_wholesale_ref_id'
     ];


    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
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
