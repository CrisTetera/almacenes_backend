<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

class SlServiceOrderPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_service_order_pos';

    /**
     * @var array
     */
    protected $fillable = [
        "cashier_user_id",
        'sl_invoice_id',
        'sl_invoice_id2',
        'sl_ticket_id',
        'sl_ticket_id2',
        //'sl_credit_note_id',
        'comment',
        'sl_service_order_type_id',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleInvoiceAffected()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlInvoicePos', 'sl_invoice_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleInvoiceNew()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlInvoicePos', 'sl_invoice_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleTicketAffected()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlTicketPos', 'sl_ticket_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleTicketNew()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlTicketPos', 'sl_ticket_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleTicketsAffected()
    {
        return $this->hasMany('Modules\Sale\Entities\SlTicketPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleTicketsNew()
    {
        return $this->hasMany('Modules\Sale\Entities\SlTicketPos', 'sl_service_order_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleInvoicesAffected()
    {
        return $this->hasMany('Modules\Sale\Entities\SlInvoicePos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSaleInvoicesNew()
    {
        return $this->hasMany('Modules\Sale\Entities\SlInvoicePos', 'sl_service_order_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function slServiceOrderType()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlServiceOrderTypePos');
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
