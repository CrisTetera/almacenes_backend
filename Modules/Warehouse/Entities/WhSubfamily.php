<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Warehouse\Services\WhSubfamilyWholesale\SubfamilyWholesaleDiscountService;

/**
 * @property int $id
 * @property int $wh_family_id
 * @property string $subfamily
 * @property boolean $flag_delete
 * @property WhFamily $whFamily
 * @property WhProduct[] $whProducts
 */
class WhSubfamily extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_subfamily';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_family_id',
        'subfamily',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whFamily()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhFamily');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whProducts()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhProduct');
    }

    /**
     * Get Discounts from a product
     *
     * @return void
     */
    public function getDiscountsAttribute() {
        $subfamilyWholesaleDiscountService = new SubfamilyWholesaleDiscountService();
        return $subfamilyWholesaleDiscountService->getWholesaleDiscount($this);
    }

}
