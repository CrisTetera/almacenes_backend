<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlTypeCustomerAccountMovement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlTypeCustomerAccountMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlTypeCustomerAccountMovement::orderBy('id'))
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
    public function show($idSlTypeCustomerAccountMovement)
    {
        return QueryBuilder::for(SlTypeCustomerAccountMovement::where('id', $idSlTypeCustomerAccountMovement))
                        ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlTypeCustomerAccountMovement  $slTypeCustomerAccountMovement
     * @return \Illuminate\Http\Response
     */
    public function edit(SlTypeCustomerAccountMovement $slTypeCustomerAccountMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlTypeCustomerAccountMovement  $slTypeCustomerAccountMovement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlTypeCustomerAccountMovement $slTypeCustomerAccountMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlTypeCustomerAccountMovement  $slTypeCustomerAccountMovement
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlTypeCustomerAccountMovement $slTypeCustomerAccountMovement)
    {
        //
    }
}
