<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Modules\Warehouse\Entities\WhUnitOfMeasurement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class WhUnitOfMeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhUnitOfMeasurement::orderBy('id'))
                            ->allowedIncludes(
                                'wh_conversion_factors_right.wh_unit_of_measurement_right',
                                'wh_conversion_factors_left.wh_unit_of_measurement_left'
                            )
                            ->allowedFilters(
                                'unity_simbol',
                                'name',
                                'minimun_unit'
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
    public function show($idWhUnitOfMeasurement)
    {
        return QueryBuilder::for(WhUnitOfMeasurement::where('id', $idWhUnitOfMeasurement))
                            ->allowedIncludes(
                                'wh_conversion_factors_right.wh_unit_of_measurement_right',
                                'wh_conversion_factors_left.wh_unit_of_measurement_left'
                            )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhUnitOfMeasurement  $whUnitOfMeasurement
     * @return \Illuminate\Http\Response
     */
    public function edit(WhUnitOfMeasurement $whUnitOfMeasurement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhUnitOfMeasurement  $whUnitOfMeasurement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhUnitOfMeasurement $whUnitOfMeasurement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhUnitOfMeasurement  $whUnitOfMeasurement
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhUnitOfMeasurement $whUnitOfMeasurement)
    {
        //
    }
}
