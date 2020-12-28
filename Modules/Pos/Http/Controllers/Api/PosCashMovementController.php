<?php

namespace Modules\Pos\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Pos\Entities\PosCashMovement;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Pos\Http\Requests\StorePosCashMovementRequest;
use Modules\Pos\Services\PosCashMovementPos\CrudPosCashMovementService;

class PosCashMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosCashMovement::orderBy('id'))
                            ->allowedIncludes(
                                'pos_cash_movement_egress_type', 
                                'pos_cash_movement_ingress_type',
                                'pos_cash_desk',
                                'g_user'
                                )
                            ->allowedFilters(
                                Filter::exact('pos_cash_movement_egress_type_id'),
                                Filter::exact('pos_cash_movement_ingress_type_id'),
                                Filter::exact('pos_cash_movement_egress_type_id'),
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
     * @return \Modules\Pos\Http\Requests\StorePosCashMovementRequest
     */
    public function store(StorePosCashMovementRequest $request)
    {
        //dump($request);
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
        return QueryBuilder::for(PosCashMovement::where('id', $idPosCashMovement))
                            ->allowedIncludes(
                                'pos_cash_movement_egress_type', 
                                'pos_cash_movement_ingress_type',
                                'pos_cash_desk',
                                'g_user'
                                )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosCashMovement  $posCashMovement
     * @return \Illuminate\Http\Response
     */
    public function edit(PosCashMovement $posCashMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosCashMovement  $posCashMovement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosCashMovement $posCashMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosCashMovement  $posCashMovement
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosCashMovement $posCashMovement)
    {
        //
    }
}
