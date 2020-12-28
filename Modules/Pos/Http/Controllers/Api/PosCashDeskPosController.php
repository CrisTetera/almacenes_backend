<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Pos\Entities\PosCashDeskPos;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class PosCashDeskPosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosCashDeskPos::orderBy('id'))
                            ->allowedFilters(
                                Filter::exact('sl_customer_id'),
                                'number')
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
    public function show($idPosCashDeskPos)
    {
        return QueryBuilder::for(PosCashDeskPos::where('id', $idPosCashDeskPos))
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosCashDeskPos  $posCashDeskPos
     * @return \Illuminate\Http\Response
     */
    public function edit(PosCashDeskPos $posCashDeskPos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosCashDeskPos  $posCashDeskPos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosCashDeskPos $posCashDeskPos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosCashDeskPos  $posCashDeskPos
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosCashDeskPos $posCashDeskPos)
    {
        //
    }
}
