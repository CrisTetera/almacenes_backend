<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_customer_account_movement_id
 * @property int $sl_service_order_id
 * @property int $sl_service_order_id2
 * @property int $sl_customer_id
 * @property int $sl_customer_branch_offices_id
 * @property string $number
 * @property string $emission_date
 * @property float $subtotal
 * @property float $discount_or_charge
 * @property float $new_subtotal
 * @property float $iva
 * @property float $total
 * @property boolean $was_replaced
 * @property boolean $flag_delete
 * @property SlCustomerAccountMovement $slCustomerAccountMovement
 * @property SlCustomer $slCustomer
 * @property SlServiceOrder $slServiceOrder
 * @property SlServiceOrder $slServiceOrder
 * @property SlCustomerAccountMovement[] $slCustomerAccountMovements
 * @property SlCustomerAccountReceivable[] $slCustomerAccountReceivables
 * @property SlDetailSaleInvoice[] $slDetailSaleInvoices
 * @property SlServiceOrder[] $slServiceOrdersWhereIsAffected
 * @property SlServiceOrder[] $slServiceOrdersWhereIsNew
 */
class SlSaleInvoice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_sale_invoice';

    /**
     * @var array
     */
    protected $appends = ['pdf_url', 'signature_url', 'xml_url'];

    /**
     * @var array
     */
    protected $fillable = [
        'number',
        'emission_date',
        'subtotal',
        'discount_or_charge',
        'new_subtotal',
        'iva',
        'total',
        'global_discount_type',
        'global_discount_apply_to',
        'global_discount_percentage',
        'pdf_path',
        'signature_path',
        'xml_path',
        'g_company_id',
        'was_replaced',
        'sl_customer_account_movement_id',
        'sl_service_order_id',
        'sl_service_order_id2',
        'sl_customer_id',
        'sl_customer_branch_offices_id',
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
    public function slCustomerBranchOffices()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerBranchOffices');
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gCompany()
    {
        return $this->belongsTo('Modules\General\Entities\GCompany');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gState()
    {
        return $this->belongsTo('Modules\General\Entities\GState');
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
    public function slCustomerAccountReceivables()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCustomerAccountReceivable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailSaleInvoices()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailSaleInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slServiceOrdersWhereIsAffected()
    {
        return $this->hasMany('Modules\Sale\Entities\SlServiceOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slServiceOrdersWhereIsNew()
    {
        return $this->hasMany('Modules\Sale\Entities\SlServiceOrder', 'sl_sale_invoice_id2');
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
