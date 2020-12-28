<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_customer_id
 * @property float $debt_amount
 * @property boolean $flag_delete
 * @property SlCustomer $slCustomer
 * @property SlCustomerAccountMovement[] $slCustomerAccountMovements
 * @property SlCustomerAccountReceivable[] $slCustomerAccountReceivables
 * @property SlDetailCustomerChargeSheet[] $slDetailCustomerChargeSheets
 * @property SlCustomer[] $slCustomers
 */
class SlCustomerAccount extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_customer_account';

    /**
     * @var array
     */
    protected $fillable = ['sl_customer_id', 'debt_amount', 'flag_delete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomer()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slCustomerAccountMovements()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCustomerAccountMovement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slCustomerAccountReceivables()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCustomerAccountReceivable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailCustomerChargeSheets()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailCustomerChargeSheet');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slCustomers()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCustomer');
    }
}
