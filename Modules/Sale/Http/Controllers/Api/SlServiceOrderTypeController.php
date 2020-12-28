<?php

namespace Modules\Sale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\Sale\Entities\SlServiceOrderType;

class SlServiceOrderTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Illuminate\Http\Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlServiceOrderType::orderBy('id'))
                        ->allowedFilters(
                            'type'
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
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @param int $idSlServiceOrderType
     * @return Response
     */
    public function show($idSlServiceOrderType)
    {
        return QueryBuilder::for(SlServiceOrderType::where('id', $idSlServiceOrderType))
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
