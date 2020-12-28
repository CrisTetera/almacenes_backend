<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $number
 * @property integer $dte_type_credit_note
 * @property string $emission_date
 * @property integer $net_total
 * @property integer $iva
 * @property integer $total
 * @property string $global_discount_type
 * @property string $global_discount_apply_to
 * @property integer $global_discount_percentage
 * @property integer $global_discount_amount
 * @property string $pdf_path
 * @property string $signature_path
 * @property string $xml_path
 * @property boolean $was_replaced
 * @property integer $sl_customer_account_movement_id
 * @property integer $sl_service_order_id
 * @property integer $sl_service_order_id2
 * @property integer $sl_customer_id
 * @property integer $g_company_id
 * @property boolean $flag_pending_send_dte
 * @property boolean $flag_delete
 * @property SlCustomerAccountMovement $slCustomerAccountMovement
 * @property SlCustomer $slCustomer
 * @property SlServiceOrder $slServiceOrder
 * @property SlCustomerAccountMovement[] $slCustomerAccountMovements
 * @property SlDetailSaleCreditNote[] $slDetailSaleCreditNotes
 * @property SlServiceOrder[] $slServiceOrders
 */
class SlSaleCreditNote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_sale_credit_note';

    /**
     * @var array
     */
    protected $appends = ['pdf_url', 'signature_url', 'xml_url'];

    /**
     * @var array
     */
    protected $fillable = [
        'number',
        'dte_type_credit_note',
        'emission_date',
        'net_total',
        'iva',
        'total',
        'global_discount_type',
        'global_discount_apply_to',
        'global_discount_percentage',
        'global_discount_amount',
        'pdf_path',
        'signature_path',
        'xml_path',
        'was_replaced',
        'sl_customer_account_movement_id',
        'sl_service_order_id',
        'sl_service_order_id2',
        'sl_customer_id',
        'g_company_id',
        'flag_pending_send_dte',
        'flag_delete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerAccountMovement()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerAccountMovement');
    }

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
    public function slServiceOrder()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlServiceOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slCustomerAccountMovements()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCustomerAccountMovement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailSaleCreditNotes()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailSaleCreditNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slServiceOrders()
    {
        return $this->hasMany('Modules\Sale\Entities\SlServiceOrder');
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
        return isset($this->pdf_path) ? url('storage/' . $this->pdf_path): null;
    }

    /**
     * @return string
     */
    public function getSignatureUrlAttribute()
    {
        return isset($this->signature_path) ? url('storage/' . $this->signature_path): null;
    }

    /**
     * @return string
     */
    public function getXmlUrlAttribute()
    {
        return isset($this->xml_path) ? url('storage/' . $this->xml_path): null;
    }

} // end function
