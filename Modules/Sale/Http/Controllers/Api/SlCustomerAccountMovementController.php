<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlCustomerAccountMovement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlCustomerAccountMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlCustomerAccountMovement::orderBy('id'))
                            ->allowedIncludes(
                                'sl_customer_account',
                                'sl_type_customer_account_movement',
                                'sl_customer_payment',
                                'sl_sale_invoice',
                                'sl_sale_credit_note',
                                'sl_sale_debit_note'
                                )
                            ->allowedFilters(
                                Filter::exact('sl_customer_account_id'),
                                Filter::exact('sl_type_customer_account_movement_id'),
                                Filter::exact('sl_customer_payment_id'),
                                Filter::exact('sl_sale_invoice_id'),
                                Filter::exact('sl_sale_credit_note_id'),
                                Filter::exact('sl_sale_debit_note_id')
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
    public function show($idSlCustomerAccountMovement)
    {
        return QueryBuilder::for(SlCustomerAccountMovement::where('id', $idSlCustomerAccountMovement))
                            ->allowedIncludes(
                                'sl_customer_account',
                                'sl_type_customer_account_movement',
                                'sl_customer_payment',
                                'sl_sale_invoice',
                                'sl_sale_credit_note',
                                'sl_sale_debit_note'
                                )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlCustomerAccountMovement  $slCustomerAccountMovement
     * @return \Illuminate\Http\Response
     */
    public function edit(SlCustomerAccountMovement $slCustomerAccountMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlCustomerAccountMovement  $slCustomerAccountMovement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlCustomerAccountMovement $slCustomerAccountMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlCustomerAccountMovement  $slCustomerAccountMovement
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlCustomerAccountMovement $slCustomerAccountMovement)
    {
        //
    }
}
