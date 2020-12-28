<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlWholesaleDiscount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Sale\Http\Requests\SlWholesale\CreateSlWholesaleDiscountRequest;
use Modules\Sale\Http\Requests\SlWholesale\EditSlWholesaleDiscountRequest;
use Modules\Sale\Services\SlWholesaleDiscount\CrudSlWholesaleDiscountService;
use Modules\Warehouse\Filters\WhProduct\FiltersWhProductSearch;
use App\Http\Response\CustomResponse;
use Illuminate\Support\Facades\DB;

class SlWholesaleDiscountController extends Controller
{

    /** @var CrudSlWholesaleDiscountService $crudSlWholesaleDiscountService */
    private $crudSlWholesaleDiscountService;

    /**
     * Constructor
     *
     * @param CrudSlWholesaleDiscountService $crudSlWholesaleDiscountService
     */
    public function __construct(CrudSlWholesaleDiscountService $crudSlWholesaleDiscountService)
    {
        $this->crudSlWholesaleDiscountService = $crudSlWholesaleDiscountService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlWholesaleDiscount::orderBy('id', 'asc'))
                                ->allowedIncludes(
                                    'g_branch_office',
                                    'wh_product'
                                )
                                ->allowedFilters(
                                    Filter::exact('g_branch_office_id'),
                                    Filter::exact('wh_product_id')
                                )
                                ->where('flag_delete', 0);

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        return $query->paginate($request->limit);
    }

    /**
     * Store a newly list of sl wholesale discount
     *
     * @param  Modules\Sale\Http\Requests\SlWholesale\CreateSlWholesaleDiscountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSlWholesaleDiscountRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->crudSlWholesaleDiscountService->store($request);
            return CustomResponse::created(['data' => $resp ]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idSlWholesaleDiscount)
    {
        return QueryBuilder::for(SlWholesaleDiscount::where('id', $idSlWholesaleDiscount))
                        ->allowedIncludes(
                            'g_branch_office',
                            'wh_product.wh_subfamily.wh_family',
                            'wh_product.wh_item',
                            'wh_product.wh_pack',
                            'wh_product.wh_packing',
                            'wh_product.wh_promo'
                        )->first();
    }

    /**
     * Update single line discount in a schema
     *
     * @param  EditSlWholesaleDiscountRequest  $request
     * @param  integer  $idProduct
     * @return \Illuminate\Http\Response
     */
    public function update(EditSlWholesaleDiscountRequest $request, $idProduct)
    {
        $response = DB::transaction(function() use (&$request, $idProduct) {
            $resp = $this->crudSlWholesaleDiscountService->update($idProduct, $request);
            return CustomResponse::ok(['data' => $resp ]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage. (logically)
     *
     * @param  integer  $idWholesaleDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy($idWholesaleDiscount)
    {
        $response = DB::transaction(function() use ($idWholesaleDiscount) {
            $resp = $this->crudSlWholesaleDiscountService->delete($idWholesaleDiscount);
            return CustomResponse::ok(['message' => 'Eliminado exitosamente' ]);
        });
        return response()->json($response, $response['http_status_code']);
    }
}
