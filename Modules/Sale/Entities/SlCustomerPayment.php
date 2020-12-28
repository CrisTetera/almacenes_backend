<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_customer_account_movement_id
 * @property int $sl_detail_customer_charge_sheet_id
 * @property int $sl_electronic_transfer_payment_id
 * @property float $amount
 * @property string $pay_date
 * @property boolean $flag_delete
 * @property SlCustomerAccountMovement $slCustomerAccountMovement
 * @property SlDetailCustomerChargeSheet $slDetailCustomerChargeSheet
 * @property SlElectronicTransferPayment $slElectronicTransferPayment
 * @property SlCustomerAccountMovement[] $slCustomerAccountMovements
 * @property SlElectronicTransferPayment[] $slElectronicTransferPayments
 */
class SlCustomerPayment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_customer_payment';

    /**
     * @var array
     */
    protected $fillable = ['sl_customer_account_movement_id', 'sl_detail_customer_charge_sheet_id', 'sl_electronic_transfer_payment_id', 'amount', 'pay_date', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerAccountMovement()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerAccountMovement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slDetailCustomerChargeSheet()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlDetailCustomerChargeSheet');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slElectronicTransferPayment()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlElectronicTransferPayment');
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
    public function slElectronicTransferPayments()
    {
        return $this->hasMany('Modules\Sale\Entities\SlElectronicTransferPayment');
    }
}
