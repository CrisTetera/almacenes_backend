<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_purchase_invoice_id
 * @property int $g_user_id
 * @property int $sl_customer_id
 * @property string $number
 * @property string $dispatch_date
 * @property string $sender_compay_name
 * @property string $sender_company_rut
 * @property string $sender_company_address
 * @property string $sender_company_comune
 * @property string $sender_company_core_business
 * @property string $sender_company_phone
 * @property boolean $flag_delete
 * @property GUser $gUser
 * @property PchPurchaseInvoice $pchPurchaseInvoice
 * @property SlCustomer $slCustomer
 * @property WhDetailDispatchGuide[] $whDetailDispatchGuides
 * @property WhDetailDispatchOrder[] $whDetailDispatchOrders
 */
class WhDispatchGuide extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_dispatch_guide';

    /**
     * @var array
     */
    protected $fillable = ['pch_purchase_invoice_id', 'g_user_id', 'sl_customer_id', 'number', 'dispatch_date', 'sender_compay_name', 'sender_company_rut', 'sender_company_address', 'sender_company_comune', 'sender_company_core_business', 'sender_company_phone', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchPurchaseInvoice()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchPurchaseInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomer()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailDispatchGuides()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailDispatchGuide');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailDispatchOrders()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailDispatchOrder');
    }
}
