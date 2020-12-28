<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_customer_account_id
 * @property int $sl_sale_invoice_id
 * @property float $amount
 * @property string $pay_date
 * @property string $real_pay_date
 * @property boolean $flag_delete
 * @property SlCustomerAccount $slCustomerAccount
 * @property SlSaleInvoice $slSaleInvoice
 * @property SlDetailCustomerChargeSheet[] $slDetailCustomerChargeSheets
 */
class SlCustomerAccountReceivable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_customer_account_receivable';

    /**
     * @var array
     */
    protected $fillable = [
        'sl_customer_account_id',
        'sl_sale_invoice_id',
        'amount',
        'pay_date',
        'real_pay_date',
        'flag_delete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerAccount()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerAccount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleInvoice()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function slDetailCustomerChargeSheets()
    {
        return $this->belongsToMany('Modules\Sale\Entities\SlDetailCustomerChargeSheet', 'sl_customer_account_receivable_sl_detail_customer_change_sheet');
    }
}
