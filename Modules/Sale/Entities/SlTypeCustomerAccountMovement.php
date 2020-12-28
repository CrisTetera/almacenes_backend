<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property SlCustomerAccountMovement[] $slCustomerAccountMovements
 */
class SlTypeCustomerAccountMovement extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_type_customer_account_movement';

    /**
     * @var array
     */
    protected $fillable = ['type'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slCustomerAccountMovements()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCustomerAccountMovement');
    }
}
