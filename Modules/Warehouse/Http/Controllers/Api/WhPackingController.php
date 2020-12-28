<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhPacking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Warehouse\Http\Requests\WhPacking\EditWhPackingRequest;
use Modules\Warehouse\Http\Requests\WhPacking\CreateWhPackingRequest;
use Modules\Warehouse\Services\WhPacking\CrudwhPackingService;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;

class WhPackingController extends Controller
{

    /** @var CrudWhPackingService $crudWhPackingService */
    private $crudWhPackingService;

    public function __construct(CrudwhPackingService $crudWhPackingService)
    {
        $this->crudWhPackingService = $crudWhPackingService;
    }

    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhPacking::orderBy('id'))
                                ->allowedIncludes('wh_product', 'wh_product_packing')
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
     * @param  CreateWhPackingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWhPackingRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->crudWhPackingService->store($request);
            return CustomResponse::created($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
    * Display the specified resource.
    *
    * @param  int $idWhPacking
    * @return \Illuminate\Http\Response
    */
    public function show($idWhPacking)
    {
        return QueryBuilder::for(WhPacking::where('id', $idWhPacking))
                            ->allowedIncludes('wh_product', 'wh_product_packing')
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditWhPackingRequest  $request
     * @param  integer  $idWhProduct
     * @return \Illuminate\Http\Response
     */
    public function update(EditWhPackingRequest $request, $idWhProduct)
    {
        $response = DB::transaction(function() use ($idWhProduct, &$request) {
            $resp = $this->crudWhPackingService->update($idWhProduct, $request);
            return CustomResponse::ok($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhPacking  $whPacking
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhPacking $whPacking)
    {
        //
    }
}
