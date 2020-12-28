<?php

namespace Modules\HR\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HR\Entities\HrEmployeePos;
use Spatie\QueryBuilder\QueryBuilder;

class HrEmployeePosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(HrEmployeePos::orderBy('id'))
                            ->allowedFilters(
                                'rut',
                                'firstnames',
                                'last_name1',
                                'last_name2',
                                'email'
                            )/*
                            ->allowedAppends(
                                'discount'
                            )*/
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
     * @return Response
     */
    public function show($idOrRutHrEmployee)
    {
        if (strpos($idOrRutHrEmployee, '-') === false) {
            return QueryBuilder::for(HrEmployeePos::where('id', $idOrRutHrEmployee))
                                /*->allowedAppends(
                                    'discount'
                                )*/
                                ->first();

        }
        return QueryBuilder::for(HrEmployeePos::where('rut', $idOrRutHrEmployee))
                            /*->allowedAppends(
                                'discount'
                            )*/
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
