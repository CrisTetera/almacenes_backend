<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchProviderAccountBank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PchProviderAccountBankController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchProviderAccountBank::orderBy('id'))
                                ->allowedIncludes('g_bank', 'g_type_account_bank', 'pch_provider', 'pch_detail_provider_payment_sheets')
                                //->allowedFilters([''])
                                ->where('flag_delete', 0);

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        else
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
    * @param  int $idPchProviderAccountBank
    * @return \Illuminate\Http\Response
    */
    public function show($idPchProviderAccountBank)
    {
        return QueryBuilder::for(PchProviderAccountBank::where('id', $idPchProviderAccountBank))
                            ->allowedIncludes('g_bank', 'g_type_account_bank', 'pch_provider', 'pch_detail_provider_payment_sheets')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Purchase\Entities\PchProviderAccountBank  $pchProviderAccountBank
     * @return \Illuminate\Http\Response
     */
    public function edit(PchProviderAccountBank $pchProviderAccountBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Purchase\Entities\PchProviderAccountBank  $pchProviderAccountBank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PchProviderAccountBank $pchProviderAccountBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Purchase\Entities\PchProviderAccountBank  $pchProviderAccountBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(PchProviderAccountBank $pchProviderAccountBank)
    {
        //
    }
}
