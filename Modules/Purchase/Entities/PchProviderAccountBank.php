<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_provider_id
 * @property int $g_bank_id
 * @property int $pch_provider_id2
 * @property int $g_type_account_bank_id
 * @property string $account_number
 * @property boolean $flag_delete
 * @property GBank $gBank
 * @property GTypeAccountBank $gTypeAccountBank
 * @property PchProvider $pchProvider
 * @property PchDetailProviderPaymentSheet[] $pchDetailProviderPaymentSheets
 */
class PchProviderAccountBank extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_provider_account_bank';

    /**
     * @var array
     */
    protected $fillable = ['pch_provider_id', 'g_bank_id', 'pch_provider_id2', 'g_type_account_bank_id', 'account_number', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gBank()
    {
        return $this->belongsTo('Modules\General\Entities\GBank');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gTypeAccountBank()
    {
        return $this->belongsTo('Modules\General\Entities\GTypeAccountBank');
    }

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
}
