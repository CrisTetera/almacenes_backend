<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $state
 * @property boolean $flag_delete
 */
class PchPurchaseOrderState extends Model
{

    public const CREATED        = 1;
    public const AUTHORIZED     = 2;
    public const PENDING_MAIL   = 3;
    public const IN_PROCESS     = 4;
    public const RECEIVED       = 5;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pch_purchase_order_state';

    /**
     * @var array
     */
    protected $fillable = ['state', 'flag_delete'];
}
