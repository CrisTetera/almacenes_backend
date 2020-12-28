<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Modules\Warehouse\Entities\WhWarehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Warehouse\Http\Requests\WhWarehouse\EditWarehouseRequest;
use Modules\Warehouse\Http\Requests\WhWarehouse\CreateWarehouseRequest;
use Modules\Warehouse\Services\WhWarehouse\WarehouseService;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;

class WhWarehouseController extends Controller
{

    /** @var WarehouseService $warehouseService */
    private $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhWarehouse::orderBy('id'))
                            ->allowedIncludes(
                                'g_branch_office',
                                'wh_warehouse_type',
                                'wh_warehouse_items.wh_item.wh_product'
                            )
                            ->allowedFilters(
                                Filter::exact('g_branch_office_id'),
                                Filter::exact('wh_warehouse_type_id'),
                                'name',
                                'description',
                                'address',
                                Filter::exact('is_waste_warehouse')
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
     * @param  CreateWarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWarehouseRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->warehouseService->store($request);
            return CustomResponse::created(['warehouse_id' => $resp ]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $idWhWarehouse
     * @return \Illuminate\Http\Response
     */
    public function show(int $idWhWarehouse)
    {
        return QueryBuilder::for(WhWarehouse::where('id', $idWhWarehouse))
                            ->allowedIncludes(
                                'g_branch_office',
                                'wh_warehouse_type',
                                'wh_warehouse_items.wh_item.wh_product'
                            )
                            ->whereFlagDelete(0)
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditWarehouseRequest  $request
     * @param  int  $idWhWarehouse
     * @return \Illuminate\Http\Response
     */
    public function update(EditWarehouseRequest $request, int $idWhWarehouse)
    {
        $response = DB::transaction(function() use (&$request, $idWhWarehouse) {
            $this->warehouseService->update($idWhWarehouse, $request);
            return CustomResponse::ok(['message' => 'Bodega actualizada con éxito' ]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idWhWarehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $idWhWarehouse)
    {
        $response = DB::transaction(function() use ($idWhWarehouse) {
            $this->warehouseService->delete($idWhWarehouse);
            return CustomResponse::ok(['message' => 'Bodega eliminada con éxito' ]);
        });
        return response()->json($response, $response['http_status_code']);
    }
}
