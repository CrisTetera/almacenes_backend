<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property SlCustomerAccountBank[] $slCustomerAccountBanks
 * @property PchProviderAccountBank[] $pchProviderAccountBanks
 */
class GTypeAccountBank extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_type_account_bank';

    /**
     * @var array
     */
    protected $fillable = ['type'];



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
    public function pchProviderAccountBanks()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchProviderAccountBank');
    }
}
