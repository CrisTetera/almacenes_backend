<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SlCustomerPos extends Model
{
    use Notifiable;
    
    public const DEFAULT_COMMUNE = 26; // La Serena

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_customer_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'rut',
        'business_name',  // Razón social
        'alias_name', // Nombre / Nombre de Fantasía
        'commercial_business', // Giro
        'address',
        'phone_number',
        'email',
        'g_commune_id',
        'is_company',
        'flag_delete'
    ];

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
        return substr($this->commercial_business, 0, 40);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gCommunePos()
    {
        return $this->belongsTo('Modules\General\Entities\GCommunePos' , 'g_commune_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSalePos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSalePos' , 'pos_sale_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleTickets()
    {
        return $this->hasMany('Modules\Sale\Entities\SlTicketPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleInvoices()
    {
        return $this->hasMany('Modules\Sale\Entities\SlInvoicePos' , 'g_commune_id');
    }
    
}
