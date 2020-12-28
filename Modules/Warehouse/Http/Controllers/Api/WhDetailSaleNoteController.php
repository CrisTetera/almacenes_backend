<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhDetailSaleNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhDetailSaleNoteController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhDetailSaleNote::orderBy('id'))
                                ->allowedIncludes('wh_product', 'wh_sale_note')
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
    * @param  int $idWhDetailSaleNote
    * @return \Illuminate\Http\Response
    */
    public function show($idWhDetailSaleNote)
    {
        return QueryBuilder::for(WhDetailSaleNote::where('id', $idWhDetailSaleNote))
                            ->allowedIncludes('wh_product', 'wh_sale_note')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailSaleNote  $whDetailSaleNote
     * @return \Illuminate\Http\Response
     */
    public function edit(WhDetailSaleNote $whDetailSaleNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhDetailSaleNote  $whDetailSaleNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhDetailSaleNote $whDetailSaleNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailSaleNote  $whDetailSaleNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhDetailSaleNote $whDetailSaleNote)
    {
        //
    }
}
