<?php

namespace Modules\Pos\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\Filter;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\Pos\Entities\PosDailyCashPos;
use Modules\Pos\Services\PosDailyCashPos\CrudPosDailyCashService;
use Modules\Pos\Http\Requests\Pos\StorePosDailyCashRequest;
use Modules\Pos\Http\Requests\Pos\GetInitialResumePosDailyCashRequest;
use Modules\Pos\Http\Requests\Pos\GetCompleteResumePosDailyCashRequest;
use Modules\Pos\Http\Requests\Pos\ClosePosDailyCashRequest;

class PosDailyCashPosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosDailyCashPos::orderBy('id'))
                            ->allowedIncludes(
                                'pos_cash_desk_pos',
                                'g_user_opening_cashier_pos',
                                'g_user_closure_cashier_pos',
                                'g_state_pos'
                            )
                            ->allowedFilters(
                                Filter::exact('pos_cash_desk_id'),
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
        return QueryBuilder::for(PosDailyCashPos::where('id', $idPosDailyCash))
                            ->allowedIncludes(
                                'pos_cash_desk_pos',
                                'g_user_pos',
                                'g_state_pos'
                            )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosDailyCashPos  $posDailyCash
     * @return \Illuminate\Http\Response
     */
    public function edit(PosDailyCashPos $posDailyCash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosDailyCashPos  $posDailyCash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosDailyCashPos $posDailyCash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosDailyCashPos  $posDailyCash
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosDailyCashPos $posDailyCash)
    {
        //
    }

    /**
     * Get initial resume of open PosDailyCash of a specific Cash Desk
     * 
     * @param Modules\Pos\Http\Requests\Pos\GetInitialResumePosDailyCashRequest $request
     * @return \Illuminate\Http\Response
     */
    public function getInitialResume(GetInitialResumePosDailyCashRequest $request)
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
     * @param Modules\Pos\Http\Requests\Pos\GetCompleteResumePosDailyCashRequest $request
     * @return \Illuminate\Http\Response
     */
    public function getCompleteResume(GetCompleteResumePosDailyCashRequest $request)
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
     * @param Modules\Pos\Http\Requests\Pos\ClosePosDailyCashRequest $request
     * @return \Illuminate\Http\Response
     */
    public function posDailyCashClose(ClosePosDailyCashRequest $request)
    {
        $crudPosDailyCashService = new CrudPosDailyCashService();
        $response = $crudPosDailyCashService->posDailyCashClose($request);

        if ($response['status'] === 'success') 
            return response()->json($response, 200);
        
        return response()->json($response, $response['http_status_code']);
    } // end function
}
