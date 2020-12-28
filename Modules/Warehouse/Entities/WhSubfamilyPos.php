<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhSubfamilyPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_subfamily_pos';

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
    public function whFamilyPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhFamilyPos' , 'wh_family_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whProductsPos()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhProductPos', 'wh_product_id');
    }

}
