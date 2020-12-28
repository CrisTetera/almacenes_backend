<?php

namespace Modules\Pos\Http\Controllers\Api;

use Modules\Pos\Entities\PosSaleNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class PosSaleNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosSaleNote::orderBy('id'))
                            ->allowedIncludes(
                                'pos_sale.pos_customer_credit_option',
                                'pos_sale.pos_sale_type',
                                'pos_sale.g_user',
                                'pos_sale.pos_cash_desk',
                                'pos_sale.pos_manual_discount',
                                'pos_sale.wh_sale_note',
                                'pos_sale.sl_customer',
                                'pos_sale.pos_sale_note',
                                'pos_sale.pos_sale_pos_payment_types',
                                'pos_sale.pos_detail_sales'
                            )
                            ->allowedFilters(
                                'number'
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
    public function show($idPosSaleNote)
    {
        return QueryBuilder::for(PosSaleNote::where('id', $idPosSaleNote))
                            ->allowedIncludes(
                                'pos_sale.pos_customer_credit_option',
                                'pos_sale.pos_sale_type',
                                'pos_sale.g_user',
                                'pos_sale.pos_cash_desk',
                                'pos_sale.pos_manual_discount',
                                'pos_sale.wh_sale_note',
                                'pos_sale.sl_customer',
                                'pos_sale.pos_sale_note',
                                'pos_sale.pos_sale_pos_payment_types',
                                'pos_sale.pos_detail_sales'
                            )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosSaleNote  $posSaleNote
     * @return \Illuminate\Http\Response
     */
    public function edit(PosSaleNote $posSaleNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosSaleNote  $posSaleNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosSaleNote $posSaleNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosSaleNote  $posSaleNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosSaleNote $posSaleNote)
    {
        //
    }
}
