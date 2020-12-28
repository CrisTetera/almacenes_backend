<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhSaleNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhSaleNoteController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhSaleNote::orderBy('id'))
                                ->allowedIncludes('g_user', 'pos_sale', 'pos_sales', 'wh_detail_sale_notes')
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
    * @param  int $idWhSaleNote
    * @return \Illuminate\Http\Response
    */
    public function show($idWhSaleNote)
    {
        return QueryBuilder::for(WhSaleNote::where('id', $idWhSaleNote))
                            ->allowedIncludes('g_user', 'pos_sale', 'pos_sales', 'wh_detail_sale_notes')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhSaleNote  $whSaleNote
     * @return \Illuminate\Http\Response
     */
    public function edit(WhSaleNote $whSaleNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhSaleNote  $whSaleNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhSaleNote $whSaleNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhSaleNote  $whSaleNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhSaleNote $whSaleNote)
    {
        //
    }
}
