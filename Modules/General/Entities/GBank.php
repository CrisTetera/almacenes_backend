<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $bank
 * @property boolean $flag_delete
 * @property SlCustomerAccountBank[] $slCustomerAccountBanks
 * @property SlCheck[] $slChecks
 * @property PchProviderAccountBank[] $pchProviderAccountBanks
 */
class GBank extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_bank';

    /**
     * @var array
     */
    protected $fillable = ['bank', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slCustomerAccountBanks()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCustomerAccountBank');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slChecks()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCheck');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchProviderAccountBanks()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchProviderAccountBank');
    }
}
