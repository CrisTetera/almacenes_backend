<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Warehouse\Http\Requests\WhItem\CreateWhItemRequest;
use Modules\Warehouse\Services\WhItem\CrudWhItemService;
use Modules\Warehouse\Http\Requests\WhItem\EditWhItemRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;

class WhItemController extends Controller
{

    /** @var CrudWhItemService $crudWhItemService */
    private $crudWhItemService;

    public function __construct(CrudWhItemService $crudWhItemService)
    {
        $this->crudWhItemService = $crudWhItemService;
    }

    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhItem::orderBy('id'))
                                ->allowedIncludes('wh_product', 'wh_unit_of_measurement', 'wh_detail_inventories', 'wh_detail_stock_adjusts',
                                                  'wh_packs', 'wh_stock_movements', 'wh_products', 'wh_warehouse_items')
                                //->allowedFilters([''])
                                ->where('flag_delete', 0);

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        else
            return $query->paginate($request->limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateWhItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWhItemRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->crudWhItemService->store($request);
            return CustomResponse::created($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
    * Display the specified resource.
    *
    * @param  int $idWhItem
    * @return \Illuminate\Http\Response
    */
    public function show($idWhItem)
    {
        return QueryBuilder::for(WhItem::where('id', $idWhItem))
                            ->allowedIncludes('wh_product', 'wh_unit_of_measurement', 'wh_detail_inventories', 'wh_detail_stock_adjusts',
                                              'wh_packs', 'wh_stock_movements', 'wh_products', 'wh_warehouse_items')
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditWhItemRequest  $request
     * @param  integer  $idWhProduct
     * @return \Illuminate\Http\Response
     */
    public function update(EditWhItemRequest $request, $idWhProduct)
    {
        $response = DB::transaction(function() use ($idWhProduct, &$request) {
            $resp = $this->crudWhItemService->update($idWhProduct, $request);
            return CustomResponse::ok($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $idWhProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($idWhProduct)
    {
        //
    }
}
