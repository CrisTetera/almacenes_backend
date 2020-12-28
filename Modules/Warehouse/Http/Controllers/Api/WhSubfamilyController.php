<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Modules\Warehouse\Entities\WhSubfamily;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Warehouse\Http\Requests\WhSubfamily\CreateWhSubfamilyRequest;
use Modules\Warehouse\Services\WhSubfamily\CrudWhSubfamilyService;
use Modules\Warehouse\Http\Requests\WhSubfamily\EditWhSubfamilyRequest;

class WhSubfamilyController extends Controller
{

    /** @var CrudWhSubfamilyService $crudWhSubfamilyService */
    private $crudWhSubfamilyService;

    public function __construct(CrudWhSubfamilyService $crudWhSubfamilyService)
    {
        $this->crudWhSubfamilyService = $crudWhSubfamilyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhSubfamily::orderBy('id'))
                            ->allowedIncludes(
                                'wh_family',
                                'wh_products'
                            )
                            ->allowedFilters(
                                Filter::exact('wh_family_id'),
                                'subfamily'
                            )
                            ->allowedAppends('discounts')
                            ->where('flag_delete', 0);

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        return $query->paginate($request->limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Modules\Warehouse\Http\Requests\WhSubfamily\CreateWhSubfamilyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWhSubfamilyRequest $request)
    {
        $response = $this->crudWhSubfamilyService->store($request);
        if ($response['status'] === 'success') {
            return response()->json($response, 201);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idWhSubFamily)
    {
        return QueryBuilder::for(WhSubfamily::where('id', $idWhSubFamily))
                            ->allowedIncludes(
                                'wh_family',
                                'wh_products'
                            )
                            ->allowedAppends('discounts')
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Modules\Warehouse\Http\Requests\WhFamily\EditWhSubfamilyRequest  $request
     * @param  \Modules\Warehouse\Entities\WhFamily  $idWhSubfamily
     * @return \Illuminate\Http\Response
     */
    public function update(EditWhSubfamilyRequest $request, $idWhSubfamily)
    {
        $response = $this->crudWhSubfamilyService->update($idWhSubfamily, $request);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage. (logically)
     *
     * @param  integer  $idWhSubfamily
     * @return \Illuminate\Http\Response
     */
    public function destroy($idWhSubfamily)
    {
        $response = $this->crudWhSubfamilyService->delete($idWhSubfamily);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }

}
