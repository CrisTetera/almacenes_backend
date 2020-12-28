<?php

namespace Modules\Pos\Http\Controllers\Api;

use Modules\Pos\Entities\PosInternalConsumption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\Pos\Services\PosInternalConsumption\GenerateInternalConsumptionService;

class PosInternalConsumptionController extends Controller
{

    /** @var GenerateInternalConsumptionService $generateInternalConsumptionService */
    private $generateInternalConsumptionService;

    public function __construct(GenerateInternalConsumptionService $generateInternalConsumptionService)
    {
        $this->generateInternalConsumptionService = $generateInternalConsumptionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosInternalConsumption::orderBy('id'))
                            ->allowedIncludes(
                                'pos_detail_internal_consumptions',
                                'g_seller_user',
                                'hr_requester_employee',
                                'g_branch_office'
                            )
                            ->allowedFilters(
                                'description'
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->generateInternalConsumptionService->store($request);
        if ($response['status'] === 'success') {
            return response()->json($response, 201);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idPosInternalConsumption)
    {
        return QueryBuilder::for(PosInternalConsumption::where('id', $idPosInternalConsumption))
                            ->allowedIncludes(
                                'pos_detail_internal_consumptions',
                                'g_seller_user',
                                'hr_requester_employee',
                                'g_branch_office'
                            )->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosInternalConsumption  $posInternalConsumption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosInternalConsumption $posInternalConsumption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosInternalConsumption  $posInternalConsumption
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosInternalConsumption $posInternalConsumption)
    {
        //
    }
}
