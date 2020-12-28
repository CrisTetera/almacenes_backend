<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlCustomerAccountReceivable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlCustomerAccountReceivableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlCustomerAccountReceivable::orderBy('id'))
                            ->allowedIncludes(
                                'sl_customer_account',
                                'sl_customer_account.sl_customer',
                                'sl_sale_invoice'
                                )
                            ->allowedFilters(
                                Filter::exact('sl_sale_invoice_id'),
                                Filter::exact('sl_customer_account_id')
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
    public function show($idSlCustomerAccountReceivable)
    {
        return QueryBuilder::for(SlCustomerAccountReceivable::where('id', $idSlCustomerAccountReceivable))
                            ->allowedIncludes(
                                'sl_customer_account',
                                'sl_customer_account.sl_customer',
                                'sl_sale_invoice'
                                )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlCustomerAccountReceivable  $slCustomerAccountReceivable
     * @return \Illuminate\Http\Response
     */
    public function edit(SlCustomerAccountReceivable $slCustomerAccountReceivable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlCustomerAccountReceivable  $slCustomerAccountReceivable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlCustomerAccountReceivable $slCustomerAccountReceivable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlCustomerAccountReceivable  $slCustomerAccountReceivable
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlCustomerAccountReceivable $slCustomerAccountReceivable)
    {
        //
    }
}
