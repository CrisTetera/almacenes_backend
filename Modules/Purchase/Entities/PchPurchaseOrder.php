<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_provider_id
 * @property int $pch_provider_branch_offices_id
 * @property int $pch_payment_condition_id
 * @property int $pch_purchase_order_state_id
 * @property int $wh_warehouse_id
 * @property int $g_originator_user_id
 * @property int $g_authorizer_user_id
 * @property boolean $email_sended
 * @property string $observation
 * @property int $net_subtotal
 * @property int $iva
 * @property int $total
 * @property int $wh_product_reception_id
 * @property boolean $flag_delete
 * @property PchProvider $pchProvider
 * @property PchDetailPurchaseOrder[] $pchDetailPurchaseOrders
 * @property WhProductReception $whProductReception
 * @property WhOrderer[] $whOrderers
 * @property WhProductReception[] $whProductReceptions
 */
class PchPurchaseOrder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pch_purchase_order';

    /**
     * @var array
     */
    protected $fillable = [
        'pch_provider_id',
        'pch_provider_branch_offices_id',
        'pch_payment_condition_id',
        'pch_purchase_order_state_id',
        'wh_warehouse_id',
        'g_originator_user_id',
        'g_authorizer_user_id',
        'email_sended',
        'observation',
        'net_subtotal',
        'iva',
        'total',
        'wh_product_reception_id',
        'flag_delete'
    ];

    public function formattedNumber()
    {
        return str_pad("$this->id", 12, '0', STR_PAD_LEFT);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchProvider()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchProvider');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchProviderBranchOffices()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchProviderBranchOffices');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchPaymentCondition()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchPaymentCondition');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchPurchaseOrderState()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchPurchaseOrderState');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whWarehouse()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehouse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gOriginatorUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_originator_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gAuthorizerUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_authorizer_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchDetailPurchaseOrders()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchDetailPurchaseOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProductReception()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProductReception');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function whOrderers()
    {
        return $this->belongsToMany('Modules\Warehouse\Entities\WhOrderer',
                                    'pch_purchase_order_wh_orderer',
                                    'pch_purchase_order_id',
                                    'wh_orderer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whProductReceptions()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhProductReception');
    }

    public function getFormattedReferences()
    {
        return $this->whOrderers()->get()->map(function($order) {
            return str_pad("$order->id", 12, '0', STR_PAD_LEFT);
        });
    }
}
