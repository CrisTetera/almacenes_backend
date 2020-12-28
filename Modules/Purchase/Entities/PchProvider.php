<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_provider_account_id
 * @property int $g_commune_id
 * @property string $rut
 * @property string $business_name
 * @property string $phone
 * @property PchProviderAccount $pchProviderAccount
 * @property GCommune $gCommune
 * @property PchProviderAccount $pchProviderAccount
 * @property PchPurchaseInvoice[] $pchPurchaseInvoices
 * @property PchPurchaseOrder[] $pchPurchaseOrders
 * @property PchProviderAccountBank[] $pchProviderAccountBanks
 * @property PchProviderAccountBank[] $pchProviderAccountBanks
 * @property PchProviderAccount[] $pchProviderAccounts
 * @property PchProviderAccount[] $pchProviderAccounts
 * @property PchPurchaseQuotation[] $pchPurchaseQuotations
 * @property PchPurchaseQuotation[] $pchPurchaseQuotations
 */
class PchProvider extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pch_provider';

    /**
     * @var array
     */
    protected $fillable = [
        'pch_provider_account_id',
        'rut',
        'business_name',
        'alias_name',
        'flag_delete'
    ];

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
    public function gCommune()
    {
        return $this->belongsTo('Modules\General\Entities\GCommune');
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
    public function pchPurchaseOrders()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchPurchaseOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchProviderAccountBanks()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchProviderAccountBank');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchProviderAccounts()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchProviderAccount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchPurchaseQuotations()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchPurchaseQuotation');
    }

    public function getBranchOfficesAttribute() {
        return PchProviderBranchOffices::with('gCommune')->where('pch_provider_id', $this->id)->where('flag_delete', false)->get();
    }

    public function formattedRut()
    {
        $rut = str_replace(['.', '-'], ['', ''], $this->rut);
        $rutNoDV = substr($rut, 0, strlen($rut) - 1);
        $dv = substr($rut, strlen($rut) - 1);
        $formattedRut = number_format($rutNoDV, 0, ',', '.').'-'.$dv;
        return $formattedRut;
    }

}
