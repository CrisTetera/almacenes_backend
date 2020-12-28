<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_customer_id
 * @property int $sl_customer_branch_offices_id
 * @property int $pos_sale_id
 * @property int $pos_sale_payment_type_id
 * @property int $g_state_id
 * @property string $reception_date
 * @property boolean $flag_delete
 * @property string $created_at
 * @property string $updated_at
 * @property SlCustomer $slCustomer
 * @property SlCustomerBranchOffice $slCustomerBranchOffice
 * @property PosSale $posSale
 * @property PosSalePaymentType $posSalePaymentType
 * @property GState $gState
 * @property WhDetailDispatchRequest[] $whDetailDispatchRequests
 */
class WhDispatchRequest extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_dispatch_request';

    /**
     * @var array
     */
    protected $fillable = ['sl_customer_id', 'sl_customer_branch_offices_id', 'pos_sale_id', 'pos_sale_payment_type_id', 'g_state_id', 'reception_date', 'flag_delete'];

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
    public function slCustomerBranchOffices()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerBranchOffices');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSale()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSalePaymentType()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSalePaymentType');
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
    public function whDetailDispatchRequests()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailDispatchRequest');
    }
}
