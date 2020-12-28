<?php

namespace Modules\Sale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\Sale\Entities\SlCommissionType;
use App\Http\Response\CustomResponse;

class SlCommissionTypeController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlCommissionType::orderBy('id'))
                            ->allowedFilters(
                                'code',
                                'type',
                                'description'
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
     * Store a newly created resource in storage.
     * @param  CreateSlCommissionRequest $request
     * @return Response
     */
    public function store(CreateSlCommissionRequest $request)
    {

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($idSlCommissionType)
    {
        return QueryBuilder::for(SlCommissionType::where('id', $idSlCommissionType))
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
