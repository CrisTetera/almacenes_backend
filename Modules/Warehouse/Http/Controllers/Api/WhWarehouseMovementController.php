<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Modules\Warehouse\Entities\WhWarehouseMovement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class WhWarehouseMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhWarehouseMovement::orderBy('id'))
                            ->allowedFilters(
                                'reason'
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idWhWarehouseMovement)
    {
        return QueryBuilder::for(WhWarehouseMovement::where('id', $idWhWarehouseMovement))
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhWarehouseMovement  $whWarehouseMovement
     * @return \Illuminate\Http\Response
     */
    public function edit(WhWarehouseMovement $whWarehouseMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhWarehouseMovement  $whWarehouseMovement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhWarehouseMovement $whWarehouseMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhWarehouseMovement  $whWarehouseMovement
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhWarehouseMovement $whWarehouseMovement)
    {
        //
    }
}
