<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_service_order_id
 * @property int $sl_service_order_id2
 * @property int $sl_customer_id
 * @property string $number
 * @property string $emission_date
 * @property float $subtotal
 * @property float $discount_or_charge
 * @property float $new_subtotal
 * @property float $total
 * @property boolean $was_replaced
 * @property boolean $flag_delete
 * @property SlCustomer $slCustomer
 * @property SlServiceOrder $slServiceOrderAsAffected
 * @property SlServiceOrder $slServiceOrderAsNew
 * @property SlDetailSaleTicket[] $slDetailSaleTickets
 * @property SlServiceOrder[] $slServiceOrdersAsAffected
 * @property SlServiceOrder[] $slServiceOrdersAsNew
 */
class SlSaleTicket extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_sale_ticket';

    /**
     * @var array
     */
    protected $appends = ['pdf_url', 'signature_url', 'xml_url'];

    /**
     * @var array
     */
    protected $fillable = [
        'number',
        'dte_type_ticket',
        'emission_date',
        'total',
        'global_discount_type',
        'global_discount_apply_to',
        'global_discount_percentage',
        'pdf_path',
        'signature_path',
        'xml_path',
        'sl_customer_id',
        'g_company_id',
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomer()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slServiceOrderAsAffected()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlServiceOrder', 'sl_service_order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slServiceOrderAsNew()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlServiceOrder', 'sl_service_order_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailSaleTickets()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailSaleTicket');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slServiceOrdersAsAffected()
    {
        return $this->hasMany('Modules\Sale\Entities\SlServiceOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slServiceOrdersAsNew()
    {
        return $this->hasMany('Modules\Sale\Entities\SlServiceOrder', 'sl_sale_ticket_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gCompany()
    {
        return $this->belongsTo('Modules\General\Entities\GCompany', 'g_company_id');
    }

    /**
     * @return string
     */
    public function getPdfUrlAttribute()
    {
        return url('storage/' . $this->pdf_path);
    }

    /**
     * @return string
     */
    public function getSignatureUrlAttribute()
    {
        return url('storage/' . $this->signature_path);
    }

    /**
     * @return string
     */
    public function getXmlUrlAttribute()
    {
        return url('storage/' . $this->xml_path);
    }

}
