<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $wh_product_id
 * @property integer $g_branch_office_id
 * @property float $cost_price
 * @property float $gains_margin
 * @property float $minimum_stock
 * @property float $maximum_stock
 * @property float $critical_stock
 */
class WhProductGBranchOffice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_product_g_branch_office';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_product_id',
        'g_branch_office_id',
        'cost_price',
        'gains_margin',
        'minimum_stock',
        'maximum_stock',
        'critical_stock',
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

}
