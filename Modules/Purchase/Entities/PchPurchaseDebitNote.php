<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_purchase_invoice_id
 * @property int $g_commune_id
 * @property int $pch_provider_account_movement_id
 * @property string $number
 * @property string $core_business
 * @property boolean $flag_delete
 * @property PchProviderAccountMovement $pchProviderAccountMovement
 * @property GCommune $gCommune
 * @property PchPurchaseInvoice $pchPurchaseInvoice
 * @property PchDetailPurchaseDebitNote[] $pchDetailPurchaseDebitNotes
 * @property PchProviderAccountMovement[] $pchProviderAccountMovements
 */
class PchPurchaseDebitNote extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_purchase_debit_note';

    /**
     * @var array
     */
    protected $fillable = ['pch_purchase_invoice_id', 'g_commune_id', 'pch_provider_account_movement_id', 'number', 'core_business', 'flag_delete'];



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
    public function gCommune()
    {
        return $this->belongsTo('Modules\General\Entities\GCommune');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchPurchaseInvoice()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchPurchaseInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchDetailPurchaseDebitNotes()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchDetailPurchaseDebitNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchProviderAccountMovements()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchProviderAccountMovement');
    }
}
