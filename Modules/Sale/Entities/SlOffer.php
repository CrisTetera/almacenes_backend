<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @property int $id
 * @property int $wh_product_id
 * @property int $g_branch_office_id
 * @property float $offer_price
 * @property string $init_datetime
 * @property string $finish_datetime
 * @property boolean $flag_delete
 * @property GBranchOffice $gBranchOffice
 * @property WhProduct $whProduct
 */
class SlOffer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_offer';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_product_id',
        'g_branch_office_id',
        'name',
        'offer_price',
        'init_datetime',
        'finish_datetime',
        'flag_delete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gBranchOffice()
    {
        return $this->belongsTo('Modules\General\Entities\GBranchOffice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }

    /**
     * Get name of product of offer
     */
    public function getNameProductAttribute()
    {
        return $this->whProduct->name;
    }

    /**
     * 
     */
    public function getUpcCodeProductAttribute()
    {
        return $this->whProduct->whProductUpcCode()->first()->upc_code;
    }

    /**
     * Scope filter for query builder. Filter SlOffer to greater or equals to $date parameter
     * 
     * @param QueryBuilder $query
     * @param string $date 
     */
    public function scopeStartsAfterOrEquals(QueryBuilder $query, $date): QueryBuilder
    {
        return $query->where('init_datetime', '>=', $date);
    }

    /**
     * Scope filter for query builder. Filter SlOffer to greater or equals to $date parameter
     * 
     * @param QueryBuilder $query
     * @param string $date 
     */
    public function scopeEndsBeforeOrEquals(QueryBuilder $query, $date): QueryBuilder
    {
        return $query->where('finish_datetime', '<=', $date);
    }
}
