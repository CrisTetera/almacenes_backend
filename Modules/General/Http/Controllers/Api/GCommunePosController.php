<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Entities\GCommunePos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class GCommunePosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(GCommunePos::orderBy('id'))
                            ->allowedIncludes('g_province_pos', 'g_province_pos.g_region_pos')
                            ->allowedFilters(['name', Filter::exact('g_province_id')])
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
    public function show($idCommune)
    {
        return  QueryBuilder::for(GCommunePos::where('id', $idCommune))
                            ->allowedIncludes('g_province_pos', 'g_province_pos.g_region_pos')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Entities\GCommunePos  $gCommune
     * @return \Illuminate\Http\Response
     */
    public function edit(GCommunePos $gCommune)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\General\Entities\GCommunePos  $gCommune
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GCommunePos $gCommune)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Entities\GCommunePos  $gCommune
     * @return \Illuminate\Http\Response
     */
    public function destroy(GCommunePos $gCommune)
    {
        //
    }
}
