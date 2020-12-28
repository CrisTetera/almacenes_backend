<?php

namespace Modules\Pos\Http\Controllers\Api;

use Modules\Pos\Entities\PosDailyCash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Pos\Services\PosDailyCash\CrudPosDailyCashService;
use Modules\Pos\Http\Requests\StorePosDailyCashRequest;
use Modules\Pos\Http\Requests\Close_PosDailyCashRequest;
use Modules\Pos\Http\Requests\GetCompleteResume_PosDailyCashRequest;
use Modules\Pos\Http\Requests\GetInitialResume_PosDailyCashRequest;

class PosDailyCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosDailyCash::orderBy('id'))
                            ->allowedIncludes(
                                'pos_cash_desk',
                                'g_user_opening_cashier',
                                'g_user_closure_cashier',
                                'g_user_supervisor',
                                'g_state'
                            )
                            ->allowedFilters(
                                Filter::exact('pos_cash_desk'),
                                Filter::exact('g_cashier_user_id'),
                                Filter::exact('g_cash_validator_user_id'),
                                Filter::exact('g_state_id'),
                                Filter::exact('flag_open_daily_cash')
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
    public function store(StorePosDailyCashRequest $request)
    {
        $crudPosDailyCashService = new CrudPosDailyCashService();
        $response = $crudPosDailyCashService->store($request);

        if ($response['status'] === 'success') 
            return response()->json($response, 200);
        
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idPosDailyCash)
    {
        return QueryBuilder::for(PosDailyCash::where('id', $idPosDailyCash))
                            ->allowedIncludes(
                                'pos_cash_desk',
                                'g_user',
                                'g_user_supervisor',
                                'g_state'
                            )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosDailyCash  $posDailyCash
     * @return \Illuminate\Http\Response
     */
    public function edit(PosDailyCash $posDailyCash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosDailyCash  $posDailyCash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosDailyCash $posDailyCash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosDailyCash  $posDailyCash
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosDailyCash $posDailyCash)
    {
        //
    }

    /**
     * Get initial resume of open PosDailyCash of a specific Cash Desk
     * 
     * @param Modules\Pos\Http\Requests\GetInitialResume_PosDailyCashRequest $request
     * @return \Illuminate\Http\Response
     */
    public function getInitialResume(GetInitialResume_PosDailyCashRequest $request)
    {
        $crudPosDailyCashService = new CrudPosDailyCashService();
        $response = $crudPosDailyCashService->getInitialResume($request);

        if ($response['status'] === 'success') 
            return response()->json($response, 200);
        
        return response()->json($response, $response['http_status_code']);
    } // end function

    /**
     * Get complete resume of open PosDailyCash of a specific Cash Desk
     * 
     * @param Modules\Pos\Http\GetCompleteResume_PosDailyCashRequest $request
     * @return \Illuminate\Http\Response
     */
    public function getCompleteResume(GetCompleteResume_PosDailyCashRequest $request)
    {
        $crudPosDailyCashService = new CrudPosDailyCashService();
        $response = $crudPosDailyCashService->getCompleteResume($request);

        if ($response['status'] === 'success') 
            return response()->json($response, 200);
        
        return response()->json($response, $response['http_status_code']);
    } // end function
  
    /**
     * Close Pos Daily Cash 
     * 
     * @param Modules\Pos\Http\Close_PosDailyCashRequest $request
     * @return \Illuminate\Http\Response
     */
    public function posDailyCashClose(Close_PosDailyCashRequest $request)
    {
        $crudPosDailyCashService = new CrudPosDailyCashService();
        $response = $crudPosDailyCashService->posDailyCashClose($request);

        if ($response['status'] === 'success') 
            return response()->json($response, 200);
        
        return response()->json($response, $response['http_status_code']);
    } // end function
}
