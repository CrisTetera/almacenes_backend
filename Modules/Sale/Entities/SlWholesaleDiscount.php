<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_product_id
 * @property int $g_branch_office_id
 * @property int $quantity_discount
 * @property float $percentage_discount
 * @property int $unit_price_discount
 * @property boolean $flag_delete
 * @property GBranchOffice $gBranchOffice
 * @property WhProduct $whProduct
 */
class SlWholesaleDiscount extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_wholesale_discount';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_product_id',
        'g_branch_office_id',
        'quantity_discount',
        'percentage_discount',
        'unit_price_discount',
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
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
