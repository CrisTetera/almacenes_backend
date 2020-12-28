<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_customer_id
 * @property float $discount_percentage
 * @property boolean $flag_delete
 * @property SlCustomer $slCustomer
 */
class SlCustomerPresetsDiscount extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_customer_presets_discount';

    /**
     * @var array
     */
    protected $fillable = ['sl_customer_id', 'discount_percentage', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomer()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomer');
    }
}
