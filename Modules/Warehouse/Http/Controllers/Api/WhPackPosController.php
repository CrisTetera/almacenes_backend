<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhPackPos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Warehouse\Services\WhPackPos\CrudWhPackService;
use Modules\Warehouse\Http\Requests\WhPackPos\CreatePackRequest;
use Modules\Warehouse\Http\Requests\WhPackPos\EditPackRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Services\WhProductPos\CrudWhProductService;
use Modules\Warehouse\Http\Requests\WhProductPos\EditProductRequest;

class WhPackPosController extends Controller
{

    /** @var CrudWhPackService $crudWhPackService */
    private $crudWhPackService;
    /** @var CrudWhProductService $crudWhProductService */
    private $crudWhProductService;

    public function __construct(CrudWhPackService $crudWhPackService,CrudWhProductService $crudWhProductService)
    {
        $this->crudWhPackService = $crudWhPackService;
        $this->crudWhProductService = $crudWhProductService;
    }

    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhPackPos::orderBy('id'))
                                ->allowedIncludes('wh_item_pos', 'wh_product_pos')
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
     * @param  CreatePackRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePackRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->crudWhProductService->store($request, 3);
            return CustomResponse::created($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
    * Display the specified resource.
    *
    * @param  int $idWhPack
    * @return \Illuminate\Http\Response
    */
    public function show($idWhPack)
    {
        return QueryBuilder::for(WhPackPos::where('id', $idWhPack))
                            ->allowedIncludes('wh_item_pos', 'wh_product_pos')
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditPackRequest  $request
     * @param  integer  $idWhProduct
     * @return \Illuminate\Http\Response
     */
    public function update(EditPackRequest $request, $idWhProduct)
    {
        $response = DB::transaction(function() use ($idWhProduct, &$request) {
            $resp = $this->crudWhProductService->update($request,$idWhProduct);
            return CustomResponse::ok($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhPack  $whPack
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhPack $whPack)
    {
        //
    }
}
