<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_customer_charge_sheet_id
 * @property int $sl_customer_charge_sheet_id2
 * @property int $sl_customer_account_id
 * @property float $amount
 * @property boolean $flag_delete
 * @property SlCustomerAccount $slCustomerAccount
 * @property SlCustomerChargeSheet $slCustomerChargeSheet
 * @property SlCustomerChargeSheet $slCustomerChargeSheet
 * @property SlCustomerPayment[] $slCustomerPayments
 * @property SlCustomerAccountReceivable[] $slCustomerAccountReceivables
 */
class SlDetailCustomerChargeSheet extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_detail_customer_charge_sheet';

    /**
     * @var array
     */
    protected $fillable = ['sl_customer_charge_sheet_id', 'sl_customer_charge_sheet_id2', 'sl_customer_account_id', 'amount', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerAccount()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerAccount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerChargeSheet()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerChargeSheet');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slCustomerPayments()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCustomerPayment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function slCustomerAccountReceivables()
    {
        return $this->belongsToMany('Modules\Sale\Entities\SlCustomerAccountReceivable', 'sl_customer_account_receivable_sl_detail_customer_change_sheet');
    }
}
