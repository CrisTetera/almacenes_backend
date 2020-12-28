<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $tag
 * @property string $description
 * @property boolean $flag_delete
 * @property WhProduct[] $whProducts
 */
class WhTag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_tag';

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
        return $this->belongsToMany('Modules\Warehouse\Entities\WhProduct', 'wh_tag_wh_product');
    }
}
