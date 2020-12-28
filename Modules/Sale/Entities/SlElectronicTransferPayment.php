<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_customer_account_bank_id
 * @property int $sl_customer_payment_id
 * @property string $number
 * @property float $amount
 * @property string $transfer_date
 * @property boolean $flag_delete
 * @property SlCustomerAccountBank $slCustomerAccountBank
 * @property SlCustomerPayment $slCustomerPayment
 * @property SlCustomerPayment[] $slCustomerPayments
 */
class SlElectronicTransferPayment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_electronic_transfer_payment';

    /**
     * @var array
     */
    protected $fillable = ['sl_customer_account_bank_id', 'sl_customer_payment_id', 'number', 'amount', 'transfer_date', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerAccountBank()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerAccountBank');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerPayment()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerPayment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slCustomerPayments()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCustomerPayment');
    }
}
