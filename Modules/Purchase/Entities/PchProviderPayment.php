<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_detail_provider_payment_sheet_id
 * @property int $pch_provider_account_movement_id
 * @property string $date_payment
 * @property float $amount_paid
 * @property boolean $flag_delete
 * @property PchDetailProviderPaymentSheet $pchDetailProviderPaymentSheet
 * @property PchProviderAccountMovement $pchProviderAccountMovement
 * @property PchDetailProviderPaymentSheet[] $pchDetailProviderPaymentSheets
 * @property PchDetailProviderPaymentSheet[] $pchDetailProviderPaymentSheets
 * @property PchProviderAccountMovement[] $pchProviderAccountMovements
 */
class PchProviderPayment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_provider_payment';

    /**
     * @var array
     */
    protected $fillable = ['pch_detail_provider_payment_sheet_id', 'pch_provider_account_movement_id', 'date_payment', 'amount_paid', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchDetailProviderPaymentSheet()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchDetailProviderPaymentSheet');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchProviderAccountMovement()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchProviderAccountMovement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchDetailProviderPaymentSheets()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchDetailProviderPaymentSheet');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchProviderAccountMovements()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchProviderAccountMovement');
    }
}
