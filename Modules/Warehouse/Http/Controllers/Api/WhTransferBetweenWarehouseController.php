<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Modules\Warehouse\Entities\WhTransferBetweenWarehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Warehouse\Services\WhTransferBetweenWarehouse\CrudTransferBetweenWarehouseService;
use Modules\Warehouse\Http\Requests\WhTransferBetweenWarehouse\CreateTransferBetweenWarehouseRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Http\Requests\WhTransferBetweenWarehouse\EditTransferBetweenWarehouseRequest;
use Modules\Warehouse\Http\Requests\WhTransferBetweenWarehouse\ReceiveTransferRequest;
use Modules\Warehouse\Services\WhTransferBetweenWarehouse\DispatchService;
use Modules\Warehouse\Services\WhTransferBetweenWarehouse\ReceptionService;

class WhTransferBetweenWarehouseController extends Controller
{
    /** @var CrudTransferBetweenWarehouseService $crudTransferBetweenWarehouseService */
    private $crudTransferBetweenWarehouseService;

    /** @var DispatchService $dispatchService */
    private $dispatchService;

    /** @var ReceptionService $receptionService */
    private $receptionService;

    public function __construct (
        CrudTransferBetweenWarehouseService $crudTransferBetweenWarehouseService,
        DispatchService $dispatchService,
        ReceptionService $receptionService
    )
    {
        $this->crudTransferBetweenWarehouseService = $crudTransferBetweenWarehouseService;
        $this->dispatchService = $dispatchService;
        $this->receptionService = $receptionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhTransferBetweenWarehouse::orderBy('id'))
                            ->allowedIncludes(
                                'wh_from_warehouse.g_branch_office',
                                'wh_to_warehouse.g_branch_office',
                                'g_from_supervisor.hr_employee',
                                'g_to_supervisor.hr_employee',
                                'wh_detail_transfer_between_warehouses',
                                'wh_detail_transfer_between_warehouses.wh_product',
                                'state'
                            )
                            ->allowedFilters(
                                Filter::exact('wh_from_warehouse_id'),
                                Filter::exact('wh_to_warehouse_id'),
                                Filter::exact('g_from_supervisor_id'),
                                Filter::exact('g_to_supervisor_id'),
                                Filter::exact('wh_transfer_between_warehouse_state_id'),
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
     * @param  CreateTransferBetweenWarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTransferBetweenWarehouseRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->crudTransferBetweenWarehouseService->store($request);
            return CustomResponse::created(['transfer_id' => $resp]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Dispatch transfer (From created to dispatched)
     *
     * @param int $id
     * @return Response
     */
    public function dispatchTransfer(int $id)
    {
        $response = DB::transaction(function() use ($id) {
            $this->dispatchService->dispatch($id);
            return CustomResponse::ok(['message' => 'La Guía de Intercambio se ha marcado como "Despachada" con éxito.']);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Receive transfer from destination warehouse (From dispatched to partial or total received)
     *
     * @param int $id
     * @param ReceiveTransferRequest $request
     * @return Response
     */
    public function receive(int $id, ReceiveTransferRequest $request)
    {
        $response = DB::transaction(function() use ($id, &$request) {
            $this->receptionService->receive($id, $request);
            return CustomResponse::ok(['message' => 'La Guía de Intercambio se ha marcado como "Recepcionada" con éxito.']);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idWhTransferBetweenWarehouse)
    {
        return QueryBuilder::for(WhTransferBetweenWarehouse::where('id', $idWhTransferBetweenWarehouse))
                        ->allowedIncludes(
                            'wh_from_warehouse.g_branch_office',
                            'wh_to_warehouse.g_branch_office',
                            'g_from_supervisor.hr_employee',
                            'g_to_supervisor.hr_employee',
                            'wh_detail_transfer_between_warehouses',
                            'wh_detail_transfer_between_warehouses.wh_product',
                            'state'
                        )
                        ->where('flag_delete', false)
                        ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditTransferBetweenWarehouseRequest  $request
     * @param  int  $idTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(EditTransferBetweenWarehouseRequest $request, int $idTransfer)
    {
        $response = DB::transaction(function() use (&$request, $idTransfer) {
            $this->crudTransferBetweenWarehouseService->update($idTransfer, $request);
            return CustomResponse::ok(['message' => 'Guía de Intercambio actualizada con éxito']);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $idTransfer)
    {
        $response = DB::transaction(function() use ($idTransfer) {
            $this->crudTransferBetweenWarehouseService->delete($idTransfer);
            return CustomResponse::ok(['message' => 'Guía de Intercambio eliminada con éxito']);
        });
        return response()->json($response, $response['http_status_code']);
    }
}
