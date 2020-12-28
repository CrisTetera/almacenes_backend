<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;

/**
 * @property int $id
 * @property string $number
 * @property int $sl_customer_id
 * @property int $sl_customer_branch_offices_id
 * @property string $emission_date
 * @property int $net_subtotal
 * @property int $discount_or_charge_percentage
 * @property int $new_net_subtotal
 * @property int $exent_total
 * @property int $iva
 * @property int $ticket_total
 * @property int $invoice_total
 * @property int $pos_sale_type_id
 * @property int $g_user_id
 * @property int g_branch_office_id
 * @property boolean flag_delete
 * @property SlCustomer $slCustomer
 * @property PosSaleType $posSaleType
 * @property GUser $gUser
 * @property gBranchOffice $gBranchOffice
 * @property SlDetailSaleQuotation[] $slDetailSaleQuotations
 */
class SlSaleQuotation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_sale_quotation';

    /**
     * @var array
     */
    protected $fillable = [
        'number',
        'emission_date',
        'sl_customer_id',
        'sl_customer_branch_offices_id',
        'net_subtotal',
        'discount_or_charge_percentage',
        'new_net_subtotal',
        'exent_total',
        'iva',
        'ticket_total',
        'invoice_total',
        'pos_sale_type_id',
        'g_user_id',
        'g_branch_office_id',
        'flag_delete'
    ];

    public function isTicket()
    {
        return $this->pos_sale_type_id == SaleConstant::TICKET;
    }

    public function saleTypeString()
    {
        return $this->pos_sale_type_id == SaleConstant::TICKET ? 'BOLETA' : 'FACTURA';
    }

    public function detailTotals()
    {
        $detailTotals = 0;
        $this->slDetailSaleQuotations()->each(function($detail) use (&$detailTotals) {
            $detailTotals += $detail->total;
        });
        return $detailTotals;
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
    public function slCustomerBranchOffices()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerBranchOffices');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSaleType()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSaleType');
    }

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
    public function gBranchOffice()
    {
        return $this->belongsTo('Modules\General\Entities\GBranchOffice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailSaleQuotations()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailSaleQuotation');
    }

    public function detailCount()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailSaleQuotation')->whereFlagDelete(0)->count();
    }
}
