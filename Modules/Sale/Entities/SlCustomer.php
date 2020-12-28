<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Modules\Sale\Notifications\SendEmailPdf_SlSaleQuotationNotification;

/**
 * @property int $id
 * @property int $sl_customer_account_id
 * @property string $rut
 * @property string $business_name
 * @property string $alias_name
 * @property string $core_business
 * @property boolean $flag_delete
 * @property SlCustomerAccount $slCustomerAccount
 * @property PosSale[] $posSales
 * @property SlCustomerAccountBank[] $slCustomerAccountBanks
 * @property SlCheck[] $slChecks
 * @property SlCustomerPresetsDiscount[] $slCustomerPresetsDiscounts
 * @property SlSaleCreditNote[] $slSaleCreditNotes
 * @property SlSaleQuotation[] $slSaleQuotations
 * @property SlSaleTicket[] $slSaleTickets
 * @property WhDispatchGuide[] $whDispatchGuides
 * @property SlSaleDebitNote[] $slSaleDebitNotes
 * @property SlSaleInvoice[] $slSaleInvoices
 * @property SlCustomerAccount[] $slCustomerAccounts
 */
class SlCustomer extends Model
{
    use Notifiable;
    
    public const DEFAULT_COMMUNE = 26; // La Serena

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_customer';

    /**
     * @var array
     */
    protected $fillable = [
        'sl_customer_account_id',
        'rut',
        'business_name',  // Razón social
        'alias_name', // Nombre / Nombre de Fantasía
        'core_business', // Giro
        'flag_delete'
    ];

    /**
     * Send email reset pass notification
     * 
     * @param object $pdf
     * @param SlSaleQuotation $slSaleQuotation
     * @return void
     */
    public function sendEmailPdf_SlSaleQuotation($pdf, SlSaleQuotation $slSaleQuotation)
    {   
        $email = $this->branchOffices()
                      ->where('id', $slSaleQuotation->sl_customer_branch_offices_id)
                      ->first()
                      ->email;
        $this->notify(new SendEmailPdf_SlSaleQuotationNotification($pdf, $email));
    } // end function

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $notification->getEmail();
    }

    /**
     * Returns formatted rut. Ex: From 12345678-9 to 12.345.678-9
     */
    public function formattedRut()
    {
        $rut = str_replace(['.', '-'], ['', ''], $this->rut);
        $rutNoDV = substr($rut, 0, strlen($rut) - 1);
        $dv = substr($rut, strlen($rut) - 1);
        $formattedRut = number_format($rutNoDV, 0, ',', '.').'-'.$dv;
        return $formattedRut;
    }

    /**
     * El SII adminte 40 caracteres, por eso se trunca el giro.
     *
     * @return void
     */
    public function getTruncatedCorebusiness()
    {
        return substr($this->core_business, 0, 40);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerAccount()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerAccount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSales()
    {
        return $this->hasMany('Modules\Sale\Entities\PosSale');
    }

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerPresetsDiscount()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerPresetsDiscount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleCreditNotes()
    {
        return $this->hasMany('Modules\Sale\Entities\SlSaleCreditNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleQuotations()
    {
        return $this->hasMany('Modules\Sale\Entities\SlSaleQuotation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleTickets()
    {
        return $this->hasMany('Modules\Sale\Entities\SlSaleTicket');
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
    public function slSaleDebitNotes()
    {
        return $this->hasMany('Modules\Sale\Entities\SlSaleDebitNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleInvoices()
    {
        return $this->hasMany('Modules\Sale\Entities\SlSaleInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slCustomerAccounts()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCustomerAccount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function branchOffices()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCustomerBranchOffices');
    }

    /**
     * Return discount of a customer
     *
     * @return void
     */
    public function getDiscountAttribute() {
        $presetDiscount = SlCustomerPresetsDiscount::where('sl_customer_id', $this->id)->where('flag_delete', false)->first();
        if ( !$presetDiscount ) {
            return 0;
        }
        return floatval($presetDiscount['discount_percentage']);
    }

    public function getBranchOfficesAttribute() {
        return SlCustomerBranchOffices::with('gCommune')->where('sl_customer_id', $this->id)->where('flag_delete', false)->get();
    }

}
