<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer pch_provider_id
 * @property integer pch_provider_branch_offices_id
 * @property integer wh_orderer_priority_id
 * @property integer g_supervisor_user_id
 * @property integer wh_warehouse_id
 * @property PchProvider $pchProvider
 * @property PchProviderBranchOffices $pchProviderBranchOffices
 * @property GUser $gSupervisorUser
 * @property WhOrdererPriority $whOrdererPriority
 * @property WhDetailOrderer[] $whDetailOrderers
 * @property PchPurchaseOrder[] $pchPurchaseOrders
 */
class WhOrderer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_orderer';

    /**
     * @var array
     */
    protected $fillable = [
        'pch_provider_id',
        'pch_provider_branch_offices_id',
        'wh_orderer_priority_id',
        'g_supervisor_user_id',
        'wh_warehouse_id',
        'flag_delete'
    ];

    protected $attribute = [
        'flag_delete' => false
    ];

    protected $appends = ['was_processed'];

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
    public function gSupervisorUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_supervisor_user_id');
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
    public function whOrdererPriority()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhOrdererPriority');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailOrderers()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailOrderer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pchPurchaseOrders()
    {
        return $this->belongsToMany('Modules\Purchase\Entities\PchPurchaseOrder',
                                    'pch_purchase_order_wh_orderer',
                                    'wh_orderer_id',
                                    'pch_purchase_order_id');
    }

    /**
     * Returns true if Orderer was proccessed (has at least one PO related)
     *
     * @return void
     */
    public function getWasProcessedAttribute()
    {
        return $this->pchPurchaseOrders()->count() > 0;
    }

}
