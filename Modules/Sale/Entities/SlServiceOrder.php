<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Sale\Services\SlServiceOrder\ServiceOrderConstant;

/**
 * @property int $id
 * @property int $g_seller_user_id
 * @property int $g_supervisor_user_id
 * @property int $sl_sale_invoice_id
 * @property int $sl_sale_invoice_id2
 * @property int $sl_sale_ticket_id
 * @property int $sl_sale_ticket_id2
 * @property int $sl_sale_credit_note_id
 * @property int $sl_service_order_type_id
 * @property string $comment
 * @property boolean $flag_delete
 * @property SlSaleCreditNote $slSaleCreditNote
 * @property SlSaleInvoice $slSaleInvoiceAffected
 * @property SlSaleInvoice $slSaleInvoiceNew
 * @property SlSaleTicket $slSaleTicketAffected
 * @property SlSaleTicket $slSaleTicketNew
 * @property SlSaleCreditNote[] $slSaleCreditNotes
 * @property SlSaleTicket[] $slSaleTicketsAffected
 * @property SlSaleTicket[] $slSaleTicketsNew
 * @property SlSaleInvoice[] $slSaleInvoicesAffected
 * @property SlSaleInvoice[] $slSaleInvoicesNew
 * @property SlServiceOrderType $slServiceOrderType
 */
class SlServiceOrder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_service_order';

    /**
     * @var array
     */
    protected $fillable = [
        "g_seller_user_id",
        "g_supervisor_user_id",
        'sl_sale_invoice_id',
        'sl_sale_invoice_id2',
        'sl_sale_ticket_id',
        'sl_sale_ticket_id2',
        'sl_sale_credit_note_id',
        'comment',
        'sl_service_order_type_id',
        'flag_delete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleCreditNote()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleCreditNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleInvoiceAffected()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleInvoice', 'sl_sale_invoice_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleInvoiceNew()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleInvoice', 'sl_sale_invoice_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleTicketAffected()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleTicket', 'sl_sale_invoice_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleTicketNew()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleTicket', 'sl_sale_ticket_id2');
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
    public function slSaleTicketsAffected()
    {
        return $this->hasMany('Modules\Sale\Entities\SlSaleTicket');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleTicketsNew()
    {
        return $this->hasMany('Modules\Sale\Entities\SlSaleTicket', 'sl_service_order_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleInvoicesAffected()
    {
        return $this->hasMany('Modules\Sale\Entities\SlSaleInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleInvoicesNew()
    {
        return $this->hasMany('Modules\Sale\Entities\SlSaleInvoice', 'sl_service_order_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function slServiceOrderType()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlServiceOrderType');
    }

    /**
     * Return true if service order type is cancel (Anulado)
     *
     * @return boolean
     */
    public function isCancelType()
    {
        return $this->sl_service_order_type_id == ServiceOrderConstant::SERVICE_ORDER_TYPE_CANCEL;
    }

    /**
     * Return true if service order type is change (Cambio)
     *
     * @return boolean
     */
    public function isChangeType()
    {
        return $this->sl_service_order_type_id == ServiceOrderConstant::SERVICE_ORDER_TYPE_CHANGE;
    }
}
