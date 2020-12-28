<?php

namespace Modules\Warehouse\Entities;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Warehouse\Entities\WhProductExcel;

class WhProductImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new WhProductExcel([
            'upc_code'      => $row[0],
            'internal_code' => $row[1],
            'name' => $row[2],
            'alias' => $row[3],
            'desc' => $row[4],
            'warranty' => $row[5],
            'is_repackaged' => $row[6],
            'is_tax_free' => $row[7],
            'is_salable' => $row[8],
            'is_consumable' => $row[9],
            'is_seasonal' => $row[10],
            'cost'  => (int) round( $row[11] ),
            'price' => (int) round( $row[12] ),
            'stock' => (int) round( $row[13] ),
            'dscto' => (int) round( $row[14] ),
            'cant'  => (int) round( $row[15] ),
            'tipo' => $row[16],
            'composition' => $row[17]
        ]);
    }
}
