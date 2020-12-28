<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Sale\Services\SlSaleTicketPos\TicketDetailService;

class SlTicketPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_ticket_pos';

    /**
     * @var array
     */
    protected $appends = ['pdf_url', 'signature_url', 'xml_url'];

    /**
     * @var array
     */
    protected $fillable = [
        'ticket_number',
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
		'flag_delete'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerPos()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerPos','sl_customer_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gCompanyPos()
    {
        return $this->belongsTo('Modules\General\Entities\GCompanyPos', 'g_company_id');
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

    public function getTicketDetailAttribute()
    {
        $ticketDetail = new TicketDetailService($this);
        return $ticketDetail->getDetail();
    }
}
