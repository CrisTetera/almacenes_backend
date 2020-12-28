<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhDetailInventoryPos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_detail_inventory_pos';

    /**
     * @var array
     */
    protected $fillable = ['wh_inventory_id', 'wh_product_id', 'expected_amount', 'amount_found', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whInventory()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhInventoryPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProductPos');
    }
}
