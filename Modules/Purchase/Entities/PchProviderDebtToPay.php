<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_purchase_invoice_id
 * @property int $pch_provider_account_id
 * @property string $date_to_pay
 * @property boolean $flag_delete
 * @property int $fee_number
 * @property float $total_paid
 * @property boolean $flag_paid
 * @property PchProviderAccount $pchProviderAccount
 * @property PchPurchaseInvoice $pchPurchaseInvoice
 * @property PchDetailProviderPaymentSheet[] $pchDetailProviderPaymentSheets
 */
class PchProviderDebtToPay extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_provider_debt_to_pay';

    /**
     * @var array
     */
    protected $fillable = ['pch_purchase_invoice_id', 'pch_provider_account_id', 'date_to_pay', 'flag_delete', 'fee_number', 'total_paid', 'flag_paid'];



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
    public function pchPurchaseInvoice()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchPurchaseInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pchDetailProviderPaymentSheets()
    {
        return $this->belongsToMany('Modules\Purchase\Entities\PchDetailProviderPaymentSheet', 'pch_provider_debt_to_pay_pch_detail_provider_payment_sheet');
    }
}
