<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhItemPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_item_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_product_id',
        'have_decimal_quantity',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProductPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProductPos', 'wh_product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whPacksPos()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhPackPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whStockMovementsPos()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhStockMovementPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whProducts()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhProductPos','wh_item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailStockAdjusts()  
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailStockAdjustPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whItemStock()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhItemStockPos');
    }
}
