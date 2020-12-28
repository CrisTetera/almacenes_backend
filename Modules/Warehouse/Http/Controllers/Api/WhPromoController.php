<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhPromo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Warehouse\Services\WhPromo\CrudWhPromoService;
use Modules\Warehouse\Http\Requests\WhPromo\CreateWhPromoRequest;
use Modules\Warehouse\Http\Requests\WhPromo\EditWhPromoRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;

class WhPromoController extends Controller
{

    /** @var CrudWhPromoService $crudWhPromoService */
    private $crudWhPromoService;

    public function __construct(CrudWhPromoService $crudWhPromoService)
    {
        $this->crudWhPromoService = $crudWhPromoService;
    }

    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhPromo::orderBy('id'))
                                ->allowedIncludes('wh_product', 'wh_products_promo')
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
     * @param  CreateWhPromoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWhPromoRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->crudWhPromoService->store($request);
            return CustomResponse::created($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
    * Display the specified resource.
    *
    * @param  int $idWhPromo
    * @return \Illuminate\Http\Response
    */
    public function show($idWhPromo)
    {
        return QueryBuilder::for(WhPromo::where('id', $idWhPromo))
                            ->allowedIncludes('wh_product', 'wh_products_promo')
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditWhPromoRequest  $request
     * @param  integer  $idWhProduct
     * @return \Illuminate\Http\Response
     */
    public function update(EditWhPromoRequest $request, $idWhProduct)
    {
        $response = DB::transaction(function() use ($idWhProduct, &$request) {
            $resp = $this->crudWhPromoService->update($idWhProduct, $request);
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
