<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlDetailSaleCreditNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlDetailSaleCreditNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlDetailSaleCreditNote::orderBy('id'))
                        ->allowedIncludes(
                            'sl_sale_credit_note.sl_customer',
                            'wh_product.wh_subfamily',
                            'wh_product.wh_item',
                            'wh_product.wh_pack',
                            'wh_product.wh_packing',
                            'wh_product.wh_promo'
                        )
                        ->allowedFilters(
                            Filter::exact('sl_sale_credit_note_id'),
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
    public function show($idSlDetailSaleCreditNote)
    {
        return QueryBuilder::for(SlDetailSaleCreditNote::where('id', $idSlDetailSaleCreditNote))
                        ->allowedIncludes(
                            'sl_sale_credit_note.sl_customer',
                            'wh_product.wh_subfamily',
                            'wh_product.wh_item',
                            'wh_product.wh_pack',
                            'wh_product.wh_packing',
                            'wh_product.wh_promo'
                        )->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlDetailSaleCreditNote  $slDetailSaleCreditNote
     * @return \Illuminate\Http\Response
     */
    public function edit(SlDetailSaleCreditNote $slDetailSaleCreditNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlDetailSaleCreditNote  $slDetailSaleCreditNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlDetailSaleCreditNote $slDetailSaleCreditNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlDetailSaleCreditNote  $slDetailSaleCreditNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlDetailSaleCreditNote $slDetailSaleCreditNote)
    {
        //
    }
}
