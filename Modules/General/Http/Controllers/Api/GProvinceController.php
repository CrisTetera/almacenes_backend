<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Entities\GProvince;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class GProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(GProvince::orderBy('id'))
                            ->allowedIncludes('g_region', 'g_communes')
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
     * @param  \Modules\General\Entities\GProvince  $gProvince
     * @return \Illuminate\Http\Response
     */
    public function show($idGProvince)
    {
        return QueryBuilder::for(GProvince::where('id', $idGProvince))
                            ->allowedIncludes('g_region', 'g_communes')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Entities\GProvince  $gProvince
     * @return \Illuminate\Http\Response
     */
    public function edit(GProvince $gProvince)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\General\Entities\GProvince  $gProvince
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GProvince $gProvince)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Entities\GProvince  $gProvince
     * @return \Illuminate\Http\Response
     */
    public function destroy(GProvince $gProvince)
    {
        //
    }
}
