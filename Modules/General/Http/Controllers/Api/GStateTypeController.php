<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Entities\GStateType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class GStateTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(GStateType::orderBy('id'))
                            ->allowedIncludes('g_states')
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
        return  QueryBuilder::for(GStateType::where('id', $idGStateType))
                            ->allowedIncludes('g_states')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Entities\GStateType  $gStateType
     * @return \Illuminate\Http\Response
     */
    public function edit(GStateType $gStateType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\General\Entities\GStateType  $gStateType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GStateType $gStateType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Entities\GStateType  $gStateType
     * @return \Illuminate\Http\Response
     */
    public function destroy(GStateType $gStateType)
    {
        //
    }
}
