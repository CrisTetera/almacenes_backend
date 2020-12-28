<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhPack;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Warehouse\Services\WhPack\CrudWhPackService;
use Modules\Warehouse\Http\Requests\WhPack\CreateWhPackRequest;
use Modules\Warehouse\Http\Requests\WhPromo\EditWhPromoRequest;
use Modules\Warehouse\Http\Requests\WhPack\EditWhPackRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;

class WhPackController extends Controller
{

    /** @var CrudWhPackService $crudWhPackService */
    private $crudWhPackService;

    public function __construct(CrudWhPackService $crudWhPackService)
    {
        $this->crudWhPackService = $crudWhPackService;
    }

    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhPack::orderBy('id'))
                                ->allowedIncludes('wh_item', 'wh_product')
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
     * @param  CreateWhPackRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWhPackRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->crudWhPackService->store($request);
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
        return QueryBuilder::for(WhPack::where('id', $idWhPack))
                            ->allowedIncludes('wh_item', 'wh_product')
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditWhPackRequest  $request
     * @param  integer  $idWhProduct
     * @return \Illuminate\Http\Response
     */
    public function update(EditWhPackRequest $request, $idWhProduct)
    {
        $response = DB::transaction(function() use ($idWhProduct, &$request) {
            $resp = $this->crudWhPackService->update($idWhProduct, $request);
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
