<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_inventory_id
 * @property int $wh_item_id
 * @property float $expected_amount
 * @property float $amount_found
 * @property boolean $flag_delete
 * @property WhInventory $whInventory
 * @property WhItem $whItem
 */
class WhDetailInventory extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_detail_inventory';

    /**
     * @var array
     */
    protected $fillable = ['wh_inventory_id', 'wh_product_id', 'expected_amount', 'amount_found', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whInventory()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhInventory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
