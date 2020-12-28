<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_customer_account_id
 * @property int $sl_type_customer_account_movement_id
 * @property int $sl_customer_payment_id
 * @property int $sl_sale_invoice_id
 * @property int $sl_sale_credit_note_id
 * @property float $sl_sale_debit_note_id
 * @property float $amount
 * @property boolean $flag_delete
 * @property SlCustomerPayment $slCustomerPayment
 * @property SlSaleCreditNote $slSaleCreditNote
 * @property SlSaleDebitNote $slSaleDebitNote
 * @property SlSaleInvoice $slSaleInvoice
 * @property SlTypeCustomerAccountMovement $slTypeCustomerAccountMovement
 * @property SlCustomerAccount $slCustomerAccount
 * @property SlCustomerPayment[] $slCustomerPayments
 * @property SlSaleCreditNote[] $slSaleCreditNotes
 * @property SlSaleDebitNote[] $slSaleDebitNotes
 * @property SlSaleInvoice[] $slSaleInvoices
 */
class SlCustomerAccountMovement extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_customer_account_movement';

    /**
     * @var array
     */
    protected $fillable = ['sl_customer_account_id', 'sl_type_customer_account_movement_id', 'sl_customer_payment_id', 'sl_sale_invoice_id', 'sl_sale_credit_note_id', 'sl_sale_debit_note_id', 'amount', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerPayment()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerPayment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleCreditNote()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleCreditNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleDebitNote()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleDebitNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleInvoice()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slTypeCustomerAccountMovement()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlTypeCustomerAccountMovement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerAccount()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerAccount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slCustomerPayments()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCustomerPayment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleCreditNotes()
    {
        return $this->hasMany('Modules\Sale\Entities\SlSaleCreditNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleDebitNotes()
    {
        return $this->hasMany('Modules\Sale\Entities\SlSaleDebitNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleInvoices()
    {
        return $this->hasMany('Modules\Sale\Entities\SlSaleInvoice');
    }
}
