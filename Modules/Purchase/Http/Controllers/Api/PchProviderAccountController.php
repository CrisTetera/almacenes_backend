<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchProviderAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PchProviderAccountController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchProviderAccount::orderBy('id'))
                                ->allowedIncludes('pch_provider', 'pch_detail_provider_payment_sheets', 
                                                  'pch_provider_debt_to_pays', 'pch_provider_account_movements')
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
    * @param  int $idPchProviderAccount
    * @return \Illuminate\Http\Response
    */
    public function show($idPchProviderAccount)
    {
        return QueryBuilder::for(PchProviderAccount::where('id', $idPchProviderAccount))
                            ->allowedIncludes('pch_provider', 'pch_detail_provider_payment_sheets', 
                                               'pch_provider_debt_to_pays', 'pch_provider_account_movements')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Purchase\Entities\PchProviderAccount  $pchProviderAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(PchProviderAccount $pchProviderAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Purchase\Entities\PchProviderAccount  $pchProviderAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PchProviderAccount $pchProviderAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Purchase\Entities\PchProviderAccount  $pchProviderAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(PchProviderAccount $pchProviderAccount)
    {
        //
    }
}
