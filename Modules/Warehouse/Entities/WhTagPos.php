<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhTagPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_tag_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'tag',
        'description',
        'flag_delete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function whProducts()
    {
        return $this->belongsToMany('Modules\Warehouse\Entities\WhProductPos', 'wh_tag_wh_product_pos');
    }
}
