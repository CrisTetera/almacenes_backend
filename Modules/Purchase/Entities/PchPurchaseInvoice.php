<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_provider_id
 * @property int $g_commune_id
 * @property int $pch_provider_account_movement_id
 * @property string $contact
 * @property boolean $flag_delete
 * @property float $subtotal
 * @property float $discount_or_charge
 * @property float $new_subtotal
 * @property float $iva
 * @property float $total
 * @property PchProviderAccountMovement $pchProviderAccountMovement
 * @property PchProvider $pchProvider
 * @property GCommune $gCommune
 * @property PchDetailPurchaseInvoice[] $pchDetailPurchaseInvoices
 * @property PchProviderDebtToPay[] $pchProviderDebtToPays
 * @property PchPurchaseDebitNote[] $pchPurchaseDebitNotes
 * @property PchPurchaseCreditNote[] $pchPurchaseCreditNotes
 * @property WhDispatchGuide[] $whDispatchGuides
 * @property PchProviderAccountMovement[] $pchProviderAccountMovements
 */
class PchPurchaseInvoice extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_purchase_invoice';

    /**
     * @var array
     */
    protected $fillable = ['pch_provider_id', 'g_commune_id', 'pch_provider_account_movement_id', 'contact', 'flag_delete', 'subtotal', 'discount_or_charge', 'new_subtotal', 'iva', 'total'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchProviderAccountMovement()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchProviderAccountMovement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchProvider()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchProvider');
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
    public function pchDetailPurchaseInvoices()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchDetailPurchaseInvoice');
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
    public function pchPurchaseDebitNotes()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchPurchaseDebitNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchPurchaseCreditNotes()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchPurchaseCreditNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDispatchGuides()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDispatchGuide');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchProviderAccountMovements()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchProviderAccountMovement');
    }
}
