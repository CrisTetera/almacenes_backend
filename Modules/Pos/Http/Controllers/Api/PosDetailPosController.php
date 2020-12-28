<?php

namespace Modules\Pos\Http\Controllers\Api;

use Modules\Pos\Entities\PosDetailPos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class PosDetailPosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosDetailPos::orderBy('id'))
                            ->allowedIncludes(
                                'pos_sale_pos',
                                'wh_product_pos.wh_subfamily',
                                'wh_product_pos.wh_item',
                                'wh_product_pos.wh_pack',
                                'wh_product_pos.wh_promo'
                            )
                            ->allowedFilters(
                                Filter::exact('pos_sale_id'),
                                Filter::exact('wh_product_id')
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
    public function show($idPosDetailSale)
    {
        return QueryBuilder::for(PosDetailPos::where('id', $idPosDetailSale))
                            ->allowedIncludes(
                                'pos_sale_pos',
                                'wh_product_pos.wh_subfamily',
                                'wh_product_pos.wh_item',
                                'wh_product_pos.wh_pack',
                                'wh_product_pos.wh_promo'
                            )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosDetailPos $posDetailSale
     * @return \Illuminate\Http\Response
     */
    public function edit(PosDetailPos $posDetailSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosDetailPos  $posDetailSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosDetailPos $posDetailSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosDetailPos  $posDetailSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosDetailPos $posDetailSale)
    {
        //
    }
}
