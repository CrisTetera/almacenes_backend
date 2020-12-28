<?php

namespace Modules\Pos\Http\Controllers\Api;

use Modules\Pos\Entities\PosSalePaymentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class PosSalePaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosSalePaymentType::orderBy('id'))
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
    public function show($idPosSalePaymentType)
    {
        return QueryBuilder::for(PosSalePaymentType::where('id', $idPosSalePaymentType))
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosSalePaymentType  $posSalePaymentType
     * @return \Illuminate\Http\Response
     */
    public function edit(PosSalePaymentType $posSalePaymentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosSalePaymentType  $posSalePaymentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosSalePaymentType $posSalePaymentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosSalePaymentType  $posSalePaymentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosSalePaymentType $posSalePaymentType)
    {
        //
    }
}
