<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhTagWhProductPos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_tag_wh_product_pos';

    /**
     * @var array
     */
    protected $fillable = [];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whTag()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhTagPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProductPos');
    }
}
