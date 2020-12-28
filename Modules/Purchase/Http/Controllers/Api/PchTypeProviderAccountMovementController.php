<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchTypeProviderAccountMovement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PchTypeProviderAccountMovementController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchTypeProviderAccountMovement::orderBy('id'))
                                ->allowedIncludes('pch_provider_account_movements')
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
    * @param  int $idPchTypeProviderAccountMovement
    * @return \Illuminate\Http\Response
    */
    public function show($idPchTypeProviderAccountMovement)
    {
        return QueryBuilder::for(PchTypeProviderAccountMovement::where('id', $idPchTypeProviderAccountMovement))
                            ->allowedIncludes('pch_provider_account_movements')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Purchase\Entities\PchTypeProviderAccountMovement  $pchTypeProviderAccountMovement
     * @return \Illuminate\Http\Response
     */
    public function edit(PchTypeProviderAccountMovement $pchTypeProviderAccountMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Purchase\Entities\PchTypeProviderAccountMovement  $pchTypeProviderAccountMovement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PchTypeProviderAccountMovement $pchTypeProviderAccountMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Purchase\Entities\PchTypeProviderAccountMovement  $pchTypeProviderAccountMovement
     * @return \Illuminate\Http\Response
     */
    public function destroy(PchTypeProviderAccountMovement $pchTypeProviderAccountMovement)
    {
        //
    }
}
