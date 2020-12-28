<?php
namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhItemPos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Warehouse\Http\Requests\WhItemPos\CreateItemRequest;
use Modules\Warehouse\Services\WhItemPos\CrudWhItemService;
use Modules\Warehouse\Http\Requests\WhItemPos\EditItemRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Http\Requests\WhProductPos\CreateProductRequest;
use Modules\Warehouse\Http\Requests\WhProductPos\EditProductRequest;
use Modules\Warehouse\Services\WhProductPos\CrudWhProductService;

class WhItemPosController extends Controller
{
    /** @var CrudWhItemService $crudWhItemService */
    private $crudWhItemService;
    /** @var CrudWhProductService $crudWhProductService */
    private $crudWhProductService;

    public function __construct(CrudWhItemService $crudWhItemService, CrudWhProductService $crudWhProductService)
    {
        $this->crudWhItemService = $crudWhItemService;
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
        $query =  QueryBuilder::for(WhItemPos::orderBy('id'))
                                ->allowedIncludes('wh_product',
                                                  'wh_packs_pos', 'wh_stock_movements_pos','wh_detail_stock_adjusts', 'wh_products', 'wh_item_stock')
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
     * @param  CreateProductRequest  $request
     * @param  integer  $idWhProduct
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request , integer  $wh_product_id)
    {
        $response = DB::transaction(function() use (&$request, $wh_product_id) {
            $resp = $this->crudWhItemService->store($request, $wh_product_id);
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
        return QueryBuilder::for(WhItemPos::where('id', $idWhItem))
                            ->allowedIncludes('wh_product',
                                              'wh_packs_pos', 'wh_stock_movements_pos', 'wh_detail_stock_adjusts','wh_products', 'wh_item_stock')
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
        $response = DB::transaction(function() use ($idWhProduct,&$request) {
            $resp = $this->crudWhItemService->update($request, $idWhProduct);
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
