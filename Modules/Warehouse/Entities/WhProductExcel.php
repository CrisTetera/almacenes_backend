<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhProductExcel extends Model
{

    protected $fillable = [
        'upc_code',
        'internal_code',
        'name',
        'alias',
        'desc',
        'warranty',
        'is_repackaged',
        'is_tax_free',
        'is_salable',
        'is_consumable',
        'is_seasonal',
        'cost',
        'price',
        'stock',
        'dscto',
        'cant',
        'type',
        'composition'
    ];

}
