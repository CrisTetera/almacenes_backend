<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property float $amount_to_pay
 * @property boolean $flag_delete
 * @property PchDetailProviderPaymentSheet[] $pchDetailProviderPaymentSheets
 */
class PchProviderPaymentSheet extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_provider_payment_sheet';

    /**
     * @var array
     */
    protected $fillable = ['amount_to_pay', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchDetailProviderPaymentSheets()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchDetailProviderPaymentSheet');
    }
}
