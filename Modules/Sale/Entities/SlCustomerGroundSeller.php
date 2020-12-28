<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $sl_customer_id
 * @property integer $sl_ground_seller_id
 * @property SlCustomer $slCustomer
 * @property SlGroundSeller $slGroundSeller
 */
class SlCustomerGroundSeller extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_customer_ground_seller';

    /**
     * @var array
     */
    protected $fillable = [
        'sl_customer_id',
        'sl_ground_seller_id'
     ];


    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomer()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slGroundSeller()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlGroundSeller');
    }
}
