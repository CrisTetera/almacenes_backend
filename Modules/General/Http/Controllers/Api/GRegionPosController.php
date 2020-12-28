<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Entities\GRegionPos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class GRegionPosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(GRegionPos::orderBy('id'))
                            ->allowedIncludes('g_provinces_pos', 'g_provinces_pos.g_communes_pos')
                            ->allowedFilters('iso_3166_2_cl')
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
    public function show($idGRegion)
    {
        return  QueryBuilder::for(GRegionPos::where('id', $idGRegion))
                            ->allowedIncludes('g_provinces', 'g_provinces.g_communes')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Entities\GRegionPos  $gRegion
     * @return \Illuminate\Http\Response
     */
    public function edit(GRegionPos $gRegion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\General\Entities\GRegionPos  $gRegion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GRegionPos $gRegion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Entities\GRegionPos  $gRegion
     * @return \Illuminate\Http\Response
     */
    public function destroy(GRegionPos $gRegion)
    {
        //
    }
}
