<?php

namespace Modules\Sale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\Sale\Entities\SlCommission;
use Spatie\QueryBuilder\Filter;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Sale\Http\Requests\SlCommission\CreateSlCommissionRequest;
use Modules\Sale\Http\Requests\SlCommission\EditSlCommissionRequest;
use Modules\Sale\Services\SlCommission\CrudSlCommissionService;
use Modules\Sale\Filters\SlCommission\FiltersSlCommissionSearch;

class SlCommissionController extends Controller
{

    /** @var CrudSlCommissionService $crudSlCommissionService */
    private $crudSlCommissionService;

    public function __construct(CrudSlCommissionService $crudSlCommissionService)
    {
        $this->crudSlCommissionService = $crudSlCommissionService;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlCommission::where('flag_delete', 0))
                            ->allowedIncludes('sl_commission_type')
                            ->allowedFilters(
                                'name',
                                'description',
                                Filter::exact('sl_commission_type_id'),
                                Filter::custom('search', FiltersSlCommissionSearch::class)
                            )
                            ->defaultSort('updated_at')
                            ->allowedSorts('name', 'description', 'percentage');

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        return $query->paginate($request->limit);
    }

    /**
     * Store a newly created resource in storage.
     * @param  CreateSlCommissionRequest $request
     * @return Response
     */
    public function store(CreateSlCommissionRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->crudSlCommissionService->store($request);
            return CustomResponse::created(['commission_id' => $resp ]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($idSlCommission)
    {
        return QueryBuilder::for(SlCommission::where('id', $idSlCommission))
                            ->allowedIncludes('sl_commission_type')
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     * @param integer $idSlCommission
     * @param EditSlCommissionRequest $request
     * @return Response
     */
    public function update(EditSlCommissionRequest $request, $idSlCommission)
    {
        $response = DB::transaction(function() use (&$request, $idSlCommission) {
            $resp = $this->crudSlCommissionService->update($idSlCommission, $request);
            return CustomResponse::ok(['commission_id' => $resp ]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     * @property integer $idSlCommission
     * @return Response
     */
    public function destroy($idSlCommission)
    {
        $response = DB::transaction(function() use ($idSlCommission) {
            $resp = $this->crudSlCommissionService->delete($idSlCommission);
            return CustomResponse::ok(['message' => 'Eliminado con éxito']);
        });
        return response()->json($response, $response['http_status_code']);
    }
}
