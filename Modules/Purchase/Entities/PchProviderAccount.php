<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_provider_id
 * @property float $debt_to_pay
 * @property PchProvider $pchProvider
 * @property PchDetailProviderPaymentSheet[] $pchDetailProviderPaymentSheets
 * @property PchProviderDebtToPay[] $pchProviderDebtToPays
 * @property PchProvider[] $pchProviders
 * @property PchProvider[] $pchProviders
 * @property PchProviderAccountMovement[] $pchProviderAccountMovements
 */
class PchProviderAccount extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pch_provider_account';

    /**
     * @var array
     */
    protected $fillable = [
        'pch_provider_id',
        'debt_to_pay'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchProvider()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchProvider');
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
    public function pchProviderDebtToPays()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchProviderDebtToPay');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchProviderAccountMovements()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchProviderAccountMovement');
    }
}
