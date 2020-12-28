<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Entities\GProvincePos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class GProvincePosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(GProvincePos::orderBy('id'))
                            ->allowedIncludes('g_region_pos', 'g_communes_pos')
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
     * @param  \Modules\General\Entities\GProvincePos  $gProvince
     * @return \Illuminate\Http\Response
     */
    public function show($idGProvince)
    {
        return QueryBuilder::for(GProvincePos::where('id', $idGProvince))
                            ->allowedIncludes('g_region_pos', 'g_communes_pos')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Entities\GProvincePos  $gProvince
     * @return \Illuminate\Http\Response
     */
    public function edit(GProvincePos $gProvince)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\General\Entities\GProvincePos  $gProvince
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GProvincePos $gProvince)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Entities\GProvincePos  $gProvince
     * @return \Illuminate\Http\Response
     */
    public function destroy(GProvincePos $gProvince)
    {
        //
    }
}
