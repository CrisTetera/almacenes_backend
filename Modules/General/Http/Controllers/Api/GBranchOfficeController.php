<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Entities\GBranchOffice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class GBranchOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(GBranchOffice::orderBy('id'))
                            ->allowedIncludes(
                                'g_company',
                                'g_commune'
                            )
                            ->allowedFilters(
                                Filter::exact('g_company_id'),
                                Filter::exact('g_commune_id'),
                                'address'
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
    public function show($idGBranchOffice)
    {
        return  QueryBuilder::for(GBranchOffice::where('id', $idGBranchOffice))
                            ->allowedIncludes(
                                'g_company',
                                'g_commune'
                            )
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\General\Entities\GBranchOffice  $gBranchOffice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GBranchOffice $gBranchOffice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Entities\GBranchOffice  $gBranchOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy(GBranchOffice $gBranchOffice)
    {
        //
    }
}
