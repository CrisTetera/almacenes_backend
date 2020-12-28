<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $pch_detail_provider_payment_sheet_id
 * @property int $pch_provider_debt_to_pay_id
 * @property PchProviderDebtToPay $pchProviderDebtToPay
 * @property PchDetailProviderPaymentSheet $pchDetailProviderPaymentSheet
 */
class PchProviderDebtToPayPchDetailProviderPaymentSheet extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_provider_debt_to_pay_pch_detail_provider_payment_sheet';

    /**
     * @var array
     */
    protected $fillable = [];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchProviderDebtToPay()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchProviderDebtToPay');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchDetailProviderPaymentSheet()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchDetailProviderPaymentSheet');
    }
}
