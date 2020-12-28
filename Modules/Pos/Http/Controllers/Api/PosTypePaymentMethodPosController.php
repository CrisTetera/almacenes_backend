<?php

namespace Modules\Pos\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Pos\Entities\PosTypePaymentMethodPos;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class PosTypePaymentMethodPosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosTypePaymentMethodPos::orderBy('id'))
                            ->allowedFilters(
                                'type'
                            );

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
    public function show($idPosTypePaymentMethod)
    {
        return QueryBuilder::for(PosTypePaymentMethodPos::where('id', $idPosTypePaymentMethod))
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosTypePaymentMethodPos  $posTypePaymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PosTypePaymentMethodPos $posTypePaymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosTypePaymentMethodPos  $posTypePaymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosTypePaymentMethodPos $posTypePaymentMethod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosTypePaymentMethodPos  $posTypePaymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosTypePaymentMethodPos $posTypePaymentMethod)
    {
        //
    }
}
