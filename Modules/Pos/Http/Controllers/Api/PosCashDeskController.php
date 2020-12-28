<?php

namespace Modules\Pos\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Pos\Entities\PosCashDesk;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class PosCashDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosCashDesk::orderBy('id'))
                            ->allowedIncludes('g_branch_office')
                            ->allowedFilters(
                                Filter::exact('g_branch_office_id'),
                                Filter::exact('sl_customer_id'),
                                'number',
                                'name')
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
    public function show($idPosCashDesk)
    {
        return QueryBuilder::for(PosCashDesk::where('id', $idPosCashDesk))
                            ->allowedIncludes('g_branch_office')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosCashDesk  $posCashDesk
     * @return \Illuminate\Http\Response
     */
    public function edit(PosCashDesk $posCashDesk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosCashDesk  $posCashDesk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosCashDesk $posCashDesk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosCashDesk  $posCashDesk
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosCashDesk $posCashDesk)
    {
        //
    }
}
