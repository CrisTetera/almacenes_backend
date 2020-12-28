<?php

namespace Modules\Warehouse\Filters\WhProduct;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Modules\Warehouse\Entities\WhWarehouse;
use Modules\General\Entities\GBranchOffice;

class FiltersWhProductCriticalStock_ByWarehouse Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        try {
            if(! isInt($value)) $value = -1;

            $whWarehouse = WhWarehouse::find($value);
            $gBranchOffice_ofWhWarehouse = GBranchOffice::find($whWarehouse->g_branch_office_id);

            // Only items products (inventariable products)
            $query->whereNotNull('wh_product.wh_item_id');

            // Get WhWarehouseItem of product (item)
            if(! isJoined($query, 'wh_warehouse_item')) { 
                $query->join('wh_warehouse_item', 'wh_product.wh_item_id', 'wh_warehouse_item.wh_item_id');
            }
            
            // Get Warehouses of GBranchOffice (of Warehouse selected by user)
            if(! isJoined($query, 'wh_warehouse')) { 
                $query->join('wh_warehouse', 'wh_warehouse_item.wh_warehouse_id', 'wh_warehouse.id')
                      ->where('wh_warehouse.g_branch_office_id', $gBranchOffice_ofWhWarehouse->id);
            }
            
            if(! isJoined($query, 'wh_product_g_branch_office')) { 
                $query->join('wh_product_g_branch_office', 'wh_product.id', 'wh_product_g_branch_office.wh_product_id')
                      ->where('wh_product_g_branch_office.g_branch_office_id', $gBranchOffice_ofWhWarehouse->id);
            }

            $query->selectRaw('wh_product.*, SUM(wh_warehouse_item.stock) AS actual_stock, SUM(wh_product_g_branch_office.critical_stock) AS critical_stock')
                  ->groupBy('wh_product.id')
                  ->havingRaw('SUM(wh_warehouse_item.stock) <= SUM(wh_product_g_branch_office.critical_stock)');


            return $query;
        }
        catch(\Exception $e) {
            return $query->whereRaw("0 = 1"); //always false, no returns result for query
        }
        
    } // end function
} // end class