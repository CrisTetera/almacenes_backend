<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_dispatch_request_id
 * @property int $wh_product_id
 * @property float $quantity_requested
 * @property boolean $flag_delete
 * @property string $created_at
 * @property string $updated_at
 * @property WhDispatchRequest $whDispatchRequest
 * @property WhProduct $whProduct
 */
class WhDetailDispatchRequest extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_detail_dispatch_request';

    /**
     * @var array
     */
    protected $fillable = ['wh_dispatch_request_id', 'wh_product_id', 'quantity_requested', 'flag_delete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whDispatchRequest()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhDispatchRequest');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
