<?php

namespace Modules\Pos\Http\Controllers\Api;

use Modules\Pos\Entities\PosSaleType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class PosSaleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosSaleType::orderBy('id'))
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
    public function show($idPosSaleType)
    {
        return QueryBuilder::for(PosSaleType::where('id', $idPosSaleType))
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosSaleType  $posSaleType
     * @return \Illuminate\Http\Response
     */
    public function edit(PosSaleType $posSaleType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosSaleType  $posSaleType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosSaleType $posSaleType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosSaleType  $posSaleType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosSaleType $posSaleType)
    {
        //
    }
}
