<?php

namespace Modules\Pos\Http\Controllers\Api;

use Modules\Pos\Entities\PosDetailSaleNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class PosDetailSaleNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosDetailSaleNote::orderBy('id'))
                            ->allowedIncludes(
                                'pos_sale_note'
                            )
                            ->allowedFilters(
                                Filter::exact('pos_sale_note_id')
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
    public function show($idPosDetailSaleNote)
    {
        return QueryBuilder::for(PosDetailSaleNote::where('id', $idPosDetailSaleNote))
                            ->allowedIncludes(
                                'pos_sale_note'
                            )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosDetailSaleNote  $posDetailSaleNote
     * @return \Illuminate\Http\Response
     */
    public function edit(PosDetailSaleNote $posDetailSaleNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosDetailSaleNote  $posDetailSaleNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosDetailSaleNote $posDetailSaleNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosDetailSaleNote  $posDetailSaleNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosDetailSaleNote $posDetailSaleNote)
    {
        //
    }
}
