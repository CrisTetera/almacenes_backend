<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhConversionFactor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhConversionFactorController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhConversionFactor::orderBy('id'))
                                ->allowedIncludes('wh_unit_of_measurement_left', 'wh_unit_of_measurement_right')
                                //->allowedFilters([''])
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
    * @param  int $idWhConversionFactor
    * @return \Illuminate\Http\Response
    */
    public function show($idWhConversionFactor)
    {
        return QueryBuilder::for(WhConversionFactor::where('id', $idWhConversionFactor))
                            ->allowedIncludes('wh_unit_of_measurement_left', 'wh_unit_of_measurement_right')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhConversionFactor  $whConversionFactor
     * @return \Illuminate\Http\Response
     */
    public function edit(WhConversionFactor $whConversionFactor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhConversionFactor  $whConversionFactor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhConversionFactor $whConversionFactor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhConversionFactor  $whConversionFactor
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhConversionFactor $whConversionFactor)
    {
        //
    }
}
