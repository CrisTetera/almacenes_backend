<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_provider_payment_id
 * @property int $pch_provider_account_bank_id
 * @property int $pch_provider_payment_id2
 * @property int $pch_provider_account_id
 * @property int $pch_provider_payment_sheet_id
 * @property float $amount
 * @property PchProviderAccountBank $pchProviderAccountBank
 * @property PchProviderPayment $pchProviderPayment
 * @property PchProviderAccount $pchProviderAccount
 * @property PchProviderPayment $pchProviderPayment
 * @property PchProviderPaymentSheet $pchProviderPaymentSheet
 * @property PchProviderDebtToPay[] $pchProviderDebtToPays
 * @property PchProviderPayment[] $pchProviderPayments
 */
class PchDetailProviderPaymentSheet extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_detail_provider_payment_sheet';

    /**
     * @var array
     */
    protected $fillable = ['pch_provider_payment_id', 'pch_provider_account_bank_id', 'pch_provider_payment_id2', 'pch_provider_account_id', 'pch_provider_payment_sheet_id', 'amount'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchProviderAccountBank()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchProviderAccountBank');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchProviderPayment()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchProviderPayment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchProviderAccount()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchProviderAccount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchProviderPaymentSheet()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchProviderPaymentSheet');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pchProviderDebtToPays()
    {
        return $this->belongsToMany('Modules\Purchase\Entities\PchProviderDebtToPay', 'pch_provider_debt_to_pay_pch_detail_provider_payment_sheet');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchProviderPayments()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchProviderPayment');
    }
}
