<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhPromoPos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Warehouse\Services\WhPromoPos\CrudWhPromoService;
use Modules\Warehouse\Http\Requests\WhPromoPos\CreatePromoRequest;
use Modules\Warehouse\Http\Requests\WhPromoPos\EditPromoRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Services\WhProductPos\CrudWhProductService;
use Modules\Warehouse\Http\Requests\WhProductPos\EditProductRequest;

class WhPromoPosController extends Controller
{

    /** @var CrudWhPromoService $crudWhPromoService */
    private $crudWhPromoService;
    /** @var CrudWhProductService $crudWhProductService */
    private $crudWhProductService;

    public function __construct(CrudWhPromoService $crudWhPromoService, CrudWhProductService $crudWhProductService)
    {
        $this->crudWhPromoService = $crudWhPromoService;
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
        $query =  QueryBuilder::for(WhPromoPos::orderBy('id'))
                                ->allowedIncludes('wh_product_pos', 'wh_products_on_promo_pos')
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
     * @param  CreatePromoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePromoRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->crudWhProductService->store($request, 2);
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
        return QueryBuilder::for(WhPromoPos::where('id', $idWhPromo))
                            ->allowedIncludes('wh_product_pos', 'wh_products_on_promo_pos')
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditProductRequest  $request
     * @param  integer  $idWhProduct
     * @return \Illuminate\Http\Response
     */
    public function update(EditProductRequest $request, $idWhProduct)
    {
        $response = DB::transaction(function() use ($idWhProduct, &$request) {
            $resp = $this->crudWhProductService->update($request, $idWhProduct);
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
