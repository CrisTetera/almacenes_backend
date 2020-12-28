<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_company_id
 * @property int $g_commune_id
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property boolean $flag_detete
 * @property GCompany $gCompany
 * @property GCommune $gCommune
 * @property PosCashDesk[] $posCashDesks
 * @property SlOffer[] $slOffers
 * @property SlWholesaleDiscount[] $slWholesaleDiscounts
 * @property WhWarehouse[] $whWarehouses
 * @property SlListPrice[] $slListPrices
 */
class GBranchOffice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'g_branch_office';

    /**
     * @var array
     */
    protected $fillable = [
        'g_company_id',
        'g_commune_id',
        'address',
        'phone',
        'email',
        'flag_detete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gCompany()
    {
        return $this->belongsTo('Modules\General\Entities\GCompany');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gCommune()
    {
        return $this->belongsTo('Modules\General\Entities\GCommune');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posCashDesks()
    {
        return $this->hasMany('Modules\Pos\Entities\PosCashDesk');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slOffers()
    {
        return $this->hasMany('Modules\Sale\Entities\SlOffer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slWholesaleDiscounts()
    {
        return $this->hasMany('Modules\Sale\Entities\SlWholesaleDiscount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whWarehouses()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhWarehouse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slListPrices()
    {
        return $this->hasMany('Modules\Sale\Entities\SlListPrice');
    }
}
