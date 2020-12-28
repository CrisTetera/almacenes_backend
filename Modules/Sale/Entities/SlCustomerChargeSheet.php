<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property float $amount
 * @property boolean $flag_delete
 * @property SlDetailCustomerChargeSheet[] $slDetailCustomerChargeSheets
 */
class SlCustomerChargeSheet extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_customer_charge_sheet';

    /**
     * @var array
     */
    protected $fillable = ['amount', 'flag_delete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailCustomerChargeSheets()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailCustomerChargeSheet');
    }
}
