<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhTransferBetweenWarehouseState;

class WhTransferBetweenWarehouseStateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhTransferBetweenWarehouseState::orderBy('id'))
                                ->allowedFilters([
                                    'state',
                                ])
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
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return QueryBuilder::for(WhTransferBetweenWarehouseState::where('id', $id))
                            ->whereFlagDelete(false)
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
