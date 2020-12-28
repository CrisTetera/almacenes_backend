<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_from_warehouse_id
 * @property int $wh_to_warehouse_id
 * @property int $g_from_supervisor_id
 * @property int $g_to_supervisor_id
 * @property int $wh_transfer_between_warehouse_state_id
 * @property string $description
 * @property string $creation_date
 * @property string $dispatch_date
 * @property string $reception_date
 * @property boolean $flag_delete
 * @property WhWarehouse $whFromWarehouse
 * @property WhWarehouse $whToWarehouse
 * @property GUser $gFromSupervisor
 * @property GUser $gToSupervisor
 * @property WhTransferBetweenWarehouseState $state
 * @property WhDetailTransferBetweenWarehouse[] $whDetailTransferBetweenWarehouses
 */
class WhTransferBetweenWarehouse extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_transfer_between_warehouse';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_from_warehouse_id',
        'wh_to_warehouse_id',
        'g_from_supervisor_id',
        'g_to_supervisor_id',
        'description',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whFromWarehouse()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehouse', 'wh_from_warehouse_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whToWarehouse()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehouse', 'wh_to_warehouse_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gFromSupervisor()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_from_supervisor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gToSupervisor()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_to_supervisor_id');
    }

    public function state()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhTransferBetweenWarehouseState', 'wh_transfer_between_warehouse_state_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailTransferBetweenWarehouses()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailTransferBetweenWarehouse');
    }

    public function deleteDetails()
    {
        $this->whDetailTransferBetweenWarehouses()->whereFlagDelete(false)->update(['flag_delete' => true]);
    }

    public function hasPendingProducts()
    {
        return $this->whDetailTransferBetweenWarehouses()->whereState(WhDetailTransferBetweenWarehouse::PENDING)->count() > 0;
    }

    public function markAsCreated()
    {
        $this->wh_transfer_between_warehouse_state_id = WhTransferBetweenWarehouseState::CREATED;
        $this->creation_date = date('Y-m-d H:i:s');
    }

    public function markAsDispatched()
    {
        $this->wh_transfer_between_warehouse_state_id = WhTransferBetweenWarehouseState::DISPATCHED;
        $this->dispatch_date = date('Y-m-d H:i:s');
    }

    public function markAsPartialReceived()
    {
        $this->wh_transfer_between_warehouse_state_id = WhTransferBetweenWarehouseState::PARTIAL_RECEPTION;
        $this->reception_date = date('Y-m-d H:i:s');
    }

    public function markAsReceived()
    {
        $this->wh_transfer_between_warehouse_state_id = WhTransferBetweenWarehouseState::TOTAL_RECEPTION;
        $this->reception_date = date('Y-m-d H:i:s');
    }
}
