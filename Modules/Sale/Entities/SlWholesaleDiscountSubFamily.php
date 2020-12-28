<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_subfamily_id
 * @property int $g_branch_office_id
 * @property int $quantity_discount
 * @property float $percentage_discount
 * @property boolean $flag_delete
 * @property GBranchOffice $gBranchOffice
 * @property WhSubfamily $whSubfamily
 */
class SlWholesaleDiscountSubFamily extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_wholesale_discount_subfamily';

    protected $appends = ['unit_price_discount'];

    /**
     * @var array
     */
    protected $fillable = [
        'wh_subfamily_id',
        'g_branch_office_id',
        'quantity_discount',
        'percentage_discount',
        'flag_delete'
    ];



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
    public function whSubfamily()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhSubfamily');
    }

    public function getUnitPriceDiscountAttribute()
    {
        return 0;
    }
}
