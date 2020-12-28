<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhOrderer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\Filter;
use Modules\Warehouse\Services\WhOrderer\OrdererService;
use Modules\Warehouse\Http\Requests\WhOrderer\CreateOrdererRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Http\Requests\WhOrderer\EditOrdererRequest;

class WhOrdererController extends Controller
{

    /** @var OrdererService $ordererService */
    private $ordererService;

    public function __construct(OrdererService $ordererService)
    {
        $this->ordererService = $ordererService;
    }

    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhOrderer::where('wh_orderer.flag_delete', 0))
                                ->allowedIncludes(
                                    'pch_provider',
                                    'pch_provider_branch_offices.g_commune',
                                    'wh_orderer_priority',
                                    'wh_warehouse',
                                    'g_supervisor_user',
                                    'wh_detail_orderers.wh_product',
                                    'pch_purchase_orders'
                                )
                                ->allowedFilters([
                                    Filter::exact('pch_provider_id'),
                                    Filter::exact('pch_provider_branch_offices_id'),
                                    Filter::exact('wh_orderer_priority_id'),
                                    Filter::exact('wh_warehouse_id'),
                                    Filter::exact('g_supervisor_user_id'),
                                ])
                                ->defaultSort('updated_at');
        
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
     * @param  CreateOrdererRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrdererRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->ordererService->store($request);
            return CustomResponse::created(['orderer_id' => $resp ]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
    * Display the specified resource.
    *
    * @param  int $idWhOrderer
    * @return \Illuminate\Http\Response
    */
    public function show($idWhOrderer)
    {
        return QueryBuilder::for(WhOrderer::where('id', $idWhOrderer))
                            ->allowedIncludes(
                                'pch_provider',
                                'pch_provider_branch_offices.g_commune',
                                'wh_orderer_priority',
                                'g_branch_office',
                                'g_supervisor_user',
                                'wh_detail_orderers.wh_product',
                                'pch_purchase_orders'
                            )
                            ->where('flag_delete', 0)
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditOrdererRequest  $request
     * @param  integer  $idWhOrderer
     * @return \Illuminate\Http\Response
     */
    public function update(EditOrdererRequest $request, $idWhOrderer)
    {
        $response = DB::transaction(function() use (&$request, $idWhOrderer) {
            $this->ordererService->update($idWhOrderer, $request);
            return CustomResponse::ok(['message' => 'Solicitud de abastecimiento ha sido actualizada con éxito' ]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idWhOrderer
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $idWhOrderer)
    {
        $response = DB::transaction(function() use ($idWhOrderer) {
            $this->ordererService->delete($idWhOrderer);
            return CustomResponse::ok(['message' => 'Solicitud de abastecimiento ha sido eliminada con éxito' ]);
        });
        return response()->json($response, $response['http_status_code']);
    }
}
