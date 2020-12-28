<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_province_id
 * @property GProvince $gProvince
 * @property PchPurchaseDebitNote[] $pchPurchaseDebitNotes
 * @property PchPurchaseInvoice[] $pchPurchaseInvoices
 * @property PchProvider[] $pchProviders
 * @property PchPurchaseCreditNote[] $pchPurchaseCreditNotes
 */
class GCommune extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_commune';

    /**
     * @var array
     */
    protected $fillable = ['g_province_id', 'name'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gProvince()
    {
        return $this->belongsTo('Modules\General\Entities\GProvince');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchPurchaseDebitNotes()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchPurchaseDebitNote');
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
    public function pchProviders()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchProvider');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchPurchaseCreditNotes()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchPurchaseCreditNote');
    }
}
