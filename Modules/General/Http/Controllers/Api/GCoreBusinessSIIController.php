<?php

namespace Modules\General\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\General\Entities\GCoreBusinessSii;

class GCoreBusinessSIIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(GCoreBusinessSii::orderBy('id'))
                            // ->allowedIncludes('g_provinces', 'g_provinces.g_communes')
                            ->allowedFilters('core', 'core_business')
                            ->where('flag_delete', false);

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        return $query->paginate($request->limit);
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
    public function show($number)
    {
        return  QueryBuilder::for(GCoreBusinessSii::where('id', $number)->orWhere('code', $number))
                            // ->allowedIncludes('g_provinces', 'g_provinces.g_communes')
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\General\Entities\GCoreBusinessSii  $gCoreBusinesSii
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GCoreBusinessSii $gCoreBusinesSii)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Entities\GCoreBusinessSii  $gCoreBusinesSii
     * @return \Illuminate\Http\Response
     */
    public function destroy(GCoreBusinessSii $gCoreBusinesSii)
    {
        //
    }
}
