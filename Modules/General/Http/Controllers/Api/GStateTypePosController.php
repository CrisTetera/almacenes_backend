<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Entities\GStateTypePos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class GStateTypePosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(GStateTypePos::orderBy('id'))
                            ->allowedIncludes('g_states_pos')
                            ->allowedFilters(['state_type'])
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
    public function show($idGStateType)
    {
        return  QueryBuilder::for(GStateTypePos::where('id', $idGStateType))
                            ->allowedIncludes('g_states_pos')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Entities\GStateTypePos  $gStateType
     * @return \Illuminate\Http\Response
     */
    public function edit(GStateTypePos $gStateType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\General\Entities\GStateTypePos  $gStateType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GStateTypePos $gStateType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Entities\GStateTypePos  $gStateType
     * @return \Illuminate\Http\Response
     */
    public function destroy(GStateTypePos $gStateType)
    {
        //
    }
}
