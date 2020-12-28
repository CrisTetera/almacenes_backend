<?php

namespace Modules\Pos\Http\Controllers\Api;

use App\Pos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Pos\Entities\PosCashDeskMovementPos;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Pos\Http\Requests\Pos\StorePosCashDeskMovementRequest;
use Modules\Pos\Services\PosCashMovementPos\CrudPosCashMovementService;

class PosCashDeskMovementPosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosCashDeskMovementPos::orderBy('id'))
                            ->allowedIncludes(
                                'pos_movement_egress_type_pos', 
                                'pos_movement_ingress_type_pos',
                                'pos_cash_desk_pos',
                                'g_user_pos'
                                )
                            ->allowedFilters(
                                Filter::exact('pos_movement_egress_type_id'),
                                Filter::exact('pos_movement_ingress_type_id'),
                                Filter::exact('pos_cash_desk_id'),
                                Filter::exact('g_user_id')
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Modules\Pos\Http\Requests\Pos\StorePosCashDeskMovementRequest
     */
    public function store(StorePosCashDeskMovementRequest $request)
    {
        $crudPosCashMovementService = new CrudPosCashMovementService();
        $response = $crudPosCashMovementService->store($request);

        if ($response['status'] === 'success') 
            return response()->json($response, 200);
        
        return response()->json($response, $response['http_status_code']);

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idPosCashMovement)
    {
        return QueryBuilder::for(PosCashDeskMovementPos::where('id', $idPosCashMovement))
                            ->allowedIncludes(
                                'pos_movement_egress_type_pos', 
                                'pos_movement_ingress_type_pos',
                                'pos_cash_desk_pos',
                                'g_user_pos'
                                )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function edit(Pos $pos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pos $pos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pos $pos)
    {
        //
    }
}
