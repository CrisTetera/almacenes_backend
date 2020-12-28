<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlCustomerPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlCustomerPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlCustomerPayment::orderBy('id'))
                            ->allowedIncludes(
                                'sl_customer_account_movement',
                                'sl_customer_account_movement.sl_customer_account',
                                'sl_customer_account_movement.sl_customer_account.sl_customer',
                                'sl_detail_customer_charge_sheet',
                                'sl_electronic_transfer_payment'
                            )
                            ->allowedFilters(
                                Filter::exact('sl_customer_account_movement_id'),
                                Filter::exact('sl_detail_customer_charge_sheet_id'),
                                Filter::exact('sl_electronic_transfer_payment_id'))
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
    public function show($idSlCustomerPayment)
    {
        return QueryBuilder::for(SlCustomerPayment::where('id', $idSlCustomerPayment))
                            ->allowedIncludes(
                                'sl_customer_account_movement',
                                'sl_customer_account_movement.sl_customer_account',
                                'sl_customer_account_movement.sl_customer_account.sl_customer',
                                'sl_detail_customer_charge_sheet',
                                'sl_electronic_transfer_payment'
                            )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlCustomerPayment  $slCustomerPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(SlCustomerPayment $slCustomerPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlCustomerPayment  $slCustomerPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlCustomerPayment $slCustomerPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlCustomerPayment  $slCustomerPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlCustomerPayment $slCustomerPayment)
    {
        //
    }
}
