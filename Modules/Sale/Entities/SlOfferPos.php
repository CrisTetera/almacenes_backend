<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class SlOfferPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_offer_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_product_id',
        'name',
        'offer_price',
        'init_datetime',
        'finish_datetime',
        'flag_delete'
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProductPos','wh_product_id');
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
    public function getUpcAttribute()
    {
        return $this->whProduct->upc;
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
