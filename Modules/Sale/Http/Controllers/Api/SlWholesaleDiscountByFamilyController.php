<?php

namespace Modules\Sale\Http\Controllers\Api;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Sale\Http\Requests\SlWholeSale\EditSlWholesaleDiscountByFamilyRequest;
use Modules\Sale\Http\Requests\SlWholeSale\CreateSlWholesaleDiscountByFamilyRequest;
use Modules\Sale\Services\SlWholesaleDiscount\CrudSlWholesaleDiscountByFamilyService;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Sale\Entities\SlWholesaleDiscountFamily;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Illuminate\Http\Request;

class SlWholesaleDiscountByFamilyController extends Controller
{
    /** @var CrudSlWholesaleDiscountByFamilyService $crudSlWholesaleDiscountByFamilyService */
    private $crudSlWholesaleDiscountByFamilyService;

    /**
     * Constructor
     *
     * @param CrudSlWholesaleDiscountByFamilyService $crudSlWholesaleDiscountByFamilyService
     */
    public function __construct(CrudSlWholesaleDiscountByFamilyService $crudSlWholesaleDiscountByFamilyService)
    {
        $this->crudSlWholesaleDiscountByFamilyService = $crudSlWholesaleDiscountByFamilyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlWholesaleDiscountFamily::orderBy('id', 'asc'))
                                ->allowedIncludes(
                                    'g_branch_office',
                                    'wh_family_id'
                                )
                                ->allowedFilters(
                                    Filter::exact('g_branch_office_id'),
                                    Filter::exact('wh_family_id')
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
     * @param  Modules\Sale\Http\Requests\SlWholesale\CreateSlWholesaleDiscountByFamilyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSlWholesaleDiscountByFamilyRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $this->crudSlWholesaleDiscountByFamilyService->store($request);
            return CustomResponse::created(['message' => 'Almacenado con éxito']);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Update single line discount in a schema
     *
     * @param  EditSlWholesaleDiscountByFamilyRequest  $request
     * @param  integer  $idFamily
     * @return \Illuminate\Http\Response
     */
    public function update(EditSlWholesaleDiscountByFamilyRequest $request, $idFamily)
    {
        $response = DB::transaction(function() use (&$request, $idFamily) {
            $this->crudSlWholesaleDiscountByFamilyService->update($idFamily, $request);
            return CustomResponse::ok(['message' => 'Actualizado con éxito']);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage. (logically)
     *
     * @param  integer  $idFamily
     * @return \Illuminate\Http\Response
     */
    public function destroy($idFamily)
    {
    }
}
