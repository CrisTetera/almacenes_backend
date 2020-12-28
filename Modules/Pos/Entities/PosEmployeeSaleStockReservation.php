<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

class PosEmployeeSaleStockReservation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_employee_sale_stock_reservation';

    /**
     * @var array
     */
    protected $fillable = [
        'pos_employee_sale_id',
        'wh_warehouse_id',
        'wh_item_id',
        'stock',
        'flag_delete'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posEmployeeSale()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosEmployeeSale');
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
    public function whItem()
    {
        return $this->belongsTo('Modules\Pos\Entities\WhItem');
    }
}
