<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhPackPos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_pack_pos';

    /**
     * @var array
     */
    protected $fillable = ['wh_product_id', 'wh_item_id', 'item_quantity', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whItemPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhItemPos','wh_item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProductPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProductPos','wh_product_id');
    }
}
