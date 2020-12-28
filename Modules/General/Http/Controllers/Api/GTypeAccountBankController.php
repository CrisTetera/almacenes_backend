<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Entities\GTypeAccountBank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class GTypeAccountBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request;
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(GTypeAccountBank::orderBy('id'))
                            ->allowedFilters(['type'])
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
    public function show($idGTypeAccountBank)
    {
        return QueryBuilder::for(GTypeAccountBank::where('id', $idGTypeAccountBank))
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Entities\GTypeAccountBank  $gTypeAccountBank
     * @return \Illuminate\Http\Response
     */
    public function edit(GTypeAccountBank $gTypeAccountBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\General\Entities\GTypeAccountBank  $gTypeAccountBank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GTypeAccountBank $gTypeAccountBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Entities\GTypeAccountBank  $gTypeAccountBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(GTypeAccountBank $gTypeAccountBank)
    {
        //
    }
}
