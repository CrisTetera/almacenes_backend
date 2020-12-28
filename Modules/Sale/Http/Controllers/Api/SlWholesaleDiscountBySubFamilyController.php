<?php

namespace Modules\Sale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Sale\Services\SlWholesaleDiscount\CrudSlWholesaleDiscountBySubFamilyService;
use Modules\Sale\Http\Requests\SlWholeSale\CreateSlWholesaleDiscountBySubFamilyRequest;
use Modules\Sale\Http\Requests\SlWholeSale\EditSlWholesaleDiscountBySubFamilyRequest;
use App\Http\Response\CustomResponse;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\Sale\Entities\SlWholesaleDiscountSubFamily;
use Spatie\QueryBuilder\Filter;

class SlWholesaleDiscountBySubFamilyController extends Controller
{
    /** @var CrudSlWholesaleDiscountBySubFamilyService $crudSlWholesaleDiscountBySubFamilyService */
    private $crudSlWholesaleDiscountBySubFamilyService;

    /**
     * Constructor
     *
     * @param CrudSlWholesaleDiscountBySubFamilyService $crudSlWholesaleDiscountBySubFamilyService
     */
    public function __construct(CrudSlWholesaleDiscountBySubFamilyService $crudSlWholesaleDiscountBySubFamilyService)
    {
        $this->crudSlWholesaleDiscountBySubFamilyService = $crudSlWholesaleDiscountBySubFamilyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlWholesaleDiscountSubFamily::orderBy('id', 'asc'))
                                ->allowedIncludes(
                                    'g_branch_office'
                                )
                                ->allowedFilters(
                                    Filter::exact('g_branch_office_id'),
                                    Filter::exact('wh_subfamily_id')
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
     * @param  Modules\Sale\Http\Requests\SlWholesale\CreateSlWholesaleDiscountBySubFamilyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSlWholesaleDiscountBySubFamilyRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $this->crudSlWholesaleDiscountBySubFamilyService->store($request);
            return CustomResponse::created(['message' => 'Almacenado con éxito']);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Update single line discount in a schema
     *
     * @param  EditSlWholesaleDiscountBySubFamilyRequest  $request
     * @param  integer  $idSubFamily
     * @return \Illuminate\Http\Response
     */
    public function update(EditSlWholesaleDiscountBySubFamilyRequest $request, $idSubFamily)
    {
        $response = DB::transaction(function() use (&$request, $idSubFamily) {
            $this->crudSlWholesaleDiscountBySubFamilyService->update($idSubFamily, $request);
            return CustomResponse::ok(['message' => 'Actualizado con éxito']);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage. (logically)
     *
     * @param  integer  $idSubFamily
     * @return \Illuminate\Http\Response
     */
    public function destroy($idSubFamily)
    {
    }

}
