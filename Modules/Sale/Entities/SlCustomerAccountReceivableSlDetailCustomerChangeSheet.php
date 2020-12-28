<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $sl_detail_customer_charge_sheet_id
 * @property int $sl_customer_account_receivable_id
 * @property SlCustomerAccountReceivable $slCustomerAccountReceivable
 * @property SlDetailCustomerChargeSheet $slDetailCustomerChargeSheet
 */
class SlCustomerAccountReceivableSlDetailCustomerChangeSheet extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_customer_account_receivable_sl_detail_customer_change_sheet';

    /**
     * @var array
     */
    protected $fillable = [];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerAccountReceivable()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerAccountReceivable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slDetailCustomerChargeSheet()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlDetailCustomerChargeSheet');
    }
}
