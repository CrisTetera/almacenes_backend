<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Warehouse\Entities\WhDispatchRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhDispatchRequestController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhDispatchRequest::where('flag_delete', 0))
                                ->allowedIncludes(
                                    'sl_customer', 'sl_customer_branch_offices', 'pos_sale', 'pos_sale_payment_type', 
                                    'g_state', 'wh_detail_dispatch_requests'
                                )
                                ->allowedFilters(
                                    Filter::exact('id'),
                                    Filter::exact('sl_customer_id'),
                                    Filter::exact('sl_customer_branch_offices_id'),
                                    Filter::exact('pos_sale_id'),
                                    Filter::exact('pos_sale_payment_type_id'),
                                    Filter::exact('g_state_id'),
                                    Filter::exact('reception_date'),
                                    Filter::exact('created_at'),
                                    Filter::exact('updated_at')
                                )
                                ->defaultSort('updated_at')
                                ->allowedSorts('id', 'reception_date', 'updated_at', 'created_at');

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        else
            return $query->paginate($request->limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Modules\Warehouse\Http\Requests\WhDispatchRequest\CreateWhDispatchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWhDispatchRequest $request)
    {
        // 
    }

    /**
    * Display the specified resource.
    *
    * @param  int $idWhDispatchRequest
    * @return \Illuminate\Http\Response
    */
    public function show($idWhDispatchRequest)
    {
        return QueryBuilder::for(WhDispatchRequest::where('id', $idWhDispatchRequest))
                            ->allowedIncludes(
                                'sl_customer', 'sl_customer_branch_offices', 'pos_sale', 'pos_sale_payment_type', 
                                'g_state', 'wh_detail_dispatch_requests'
                            )
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Modules\Warehouse\Http\Requests\WhDispatchRequest\EditWhDispatchRequest  $request
     * @param  \Modules\Warehouse\Entities\WhDispatchRequest  $idWhDispatchRequest
     * @return \Illuminate\Http\Response
     */
    public function update(EditWhDispatchRequest $request, $idWhDispatchRequest)
    {
        // 
    }

    /**
     * Remove the specified resource from storage. (logically)
     *
     * @param  integer  $idWhDispatchRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($idWhDispatchRequest)
    {
// 
    }
}
