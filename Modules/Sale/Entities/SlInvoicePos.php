<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Sale\Services\SlSaleInvoicePos\InvoiceDetailService;
use Modules\Pos\Entities\PosSalePos;
use Modules\Sale\Services\SlSaleInvoicePos\CrudSlSaleInvoiceService;

class SlInvoicePos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_invoice_pos';

    /**
     * @var array
     */
    protected $appends = ['pdf_url', 'signature_url', 'xml_url'];

    /**
     * @var array
     */
    protected $fillable = [
        'invoice_number',
        'emission_date',
        'net_total',
		'iva',
        'total',
        'global_discount_type',
        'global_discount_apply_to',
        'global_discount_percentage',
        'sl_customer_id',
        'document_token',
        'pdf_path',
        'signature_path',
        'xml_path',
        'was_replaced',
        'g_company_id',
        'g_state_id',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerPos()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerPos', 'sl_customer_id');
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
    public function gStatePos()
    {
        return $this->belongsTo('Modules\General\Entities\GStatePos', 'g_state_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slServiceOrderAsAffected()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlServiceOrderPos', 'sl_service_order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slServiceOrderAsNew()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlServiceOrderPos', 'sl_service_order_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slServiceOrdersWhereIsAffected()
    {
        return $this->hasMany('Modules\Sale\Entities\SlServiceOrderPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slServiceOrdersWhereIsNew()
    {
        return $this->hasMany('Modules\Sale\Entities\SlServiceOrderPos', 'sl_sale_invoice_id2');
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

    public function getInvoiceDetailAttribute()
    {
        $invoiceDetail = new InvoiceDetailService($this);
        return $invoiceDetail->getDetail();
    }

    // public function getInvoiceDetailAttribute(){
    //     $posSale = PosSalePos::where('sl_invoice_id',$this->id)->where('flag_delete',false)->first();
    //     $invoiceDetailService = new InvoiceDetailService($posSale);
        
    //     if (SlInvoicePos::where('id',$this->id)->where('flag_delete',0)
    //         ->first()){
    //         return $invoiceDetailService->getDetail($this->id);
    //     }else{
    //         return null;
    //     }
        
    // }

    
}
