<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_type_provider_account_movement_id
 * @property int $pch_provider_account_id
 * @property int $pch_type_provider_account_movement_id2
 * @property int $pch_provider_payment_id
 * @property int $pch_purchase_credit_note_id
 * @property int $pch_purchase_debit_note_id
 * @property int $pch_purchase_invoice_id
 * @property boolean $flag_delete
 * @property PchProviderAccount $pchProviderAccount
 * @property PchPurchaseCreditNote $pchPurchaseCreditNote
 * @property PchPurchaseDebitNote $pchPurchaseDebitNote
 * @property PchPurchaseInvoice $pchPurchaseInvoice
 * @property PchTypeProviderAccountMovement $pchTypeProviderAccountMovement
 * @property PchProviderPayment $pchProviderPayment
 * @property PchTypeProviderAccountMovement $pchTypeProviderAccountMovement
 * @property PchPurchaseDebitNote[] $pchPurchaseDebitNotes
 * @property PchPurchaseInvoice[] $pchPurchaseInvoices
 * @property PchPurchaseCreditNote[] $pchPurchaseCreditNotes
 * @property PchProviderPayment[] $pchProviderPayments
 */
class PchProviderAccountMovement extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_provider_account_movement';

    /**
     * @var array
     */
    protected $fillable = ['pch_type_provider_account_movement_id', 'pch_provider_account_id', 'pch_type_provider_account_movement_id2', 'pch_provider_payment_id', 'pch_purchase_credit_note_id', 'pch_purchase_debit_note_id', 'pch_purchase_invoice_id', 'flag_delete'];



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
    public function pchPurchaseCreditNote()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchPurchaseCreditNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchPurchaseDebitNote()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchPurchaseDebitNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchPurchaseInvoice()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchPurchaseInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchTypeProviderAccountMovement()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchTypeProviderAccountMovement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchProviderPayment()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchProviderPayment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchPurchaseDebitNotes()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchPurchaseDebitNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchPurchaseInvoices()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchPurchaseInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchPurchaseCreditNotes()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchPurchaseCreditNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchProviderPayments()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchProviderPayment');
    }
}
