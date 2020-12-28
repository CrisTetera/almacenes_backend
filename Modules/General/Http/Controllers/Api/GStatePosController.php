<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Entities\GStatePos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class GStatePosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(GStatePos::orderBy('id'))
                            ->allowedIncludes('g_state_type_pos')
                            ->allowedFilters(['g_state_type_id', 'state'])
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
    public function show($idGState)
    {
        return QueryBuilder::for(GStatePos::where('id', $idGState))
                            ->allowedIncludes('g_state_type_pos')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Entities\GStatePos  $gState
     * @return \Illuminate\Http\Response
     */
    public function edit(GStatePos $gState)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\General\Entities\GStatePos  $gState
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GStatePos $gState)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Entities\GStatePos  $gState
     * @return \Illuminate\Http\Response
     */
    public function destroy(GStatePos $gState)
    {
        //
    }
}
