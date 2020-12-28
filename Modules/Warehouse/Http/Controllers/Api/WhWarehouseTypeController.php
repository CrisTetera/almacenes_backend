<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Modules\Warehouse\Entities\WhWarehouseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Services\WhWarehouseType\WarehouseTypeService;
use Modules\Warehouse\Http\Requests\WhWarehouseType\CreateWarehouseTypeRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Http\Requests\WhWarehouseType\EditWarehouseTypeRequest;

class WhWarehouseTypeController extends Controller
{

    /** @var WarehouseTypeService $warehouseTypeService */
    private $warehouseTypeService;

    public function __construct(WarehouseTypeService $warehouseTypeService)
    {
        $this->warehouseTypeService = $warehouseTypeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhWarehouseType::orderBy('id'))
                            ->allowedFilters(
                                'type'
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
     * @param  CreateWarehouseTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWarehouseTypeRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->warehouseTypeService->store($request);
            return CustomResponse::created(['warehouse_type_id' => $resp ]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idWhWarehouseType)
    {
        return QueryBuilder::for(WhWarehouseType::where('id', $idWhWarehouseType))
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditWarehouseTypeRequest  $request
     * @param  int  $idWhWarehouseType
     * @return \Illuminate\Http\Response
     */
    public function update(EditWarehouseTypeRequest $request, int $idWhWarehouseType)
    {
        $response = DB::transaction(function() use (&$request, $idWhWarehouseType) {
            $this->warehouseTypeService->update($idWhWarehouseType, $request);
            return CustomResponse::ok(['message' => 'Tipo de bodega actualizado con éxito' ]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idWhWarehouseType
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $idWhWarehouseType)
    {
        $response = DB::transaction(function() use ($idWhWarehouseType) {
            $this->warehouseTypeService->delete($idWhWarehouseType);
            return CustomResponse::ok(['message' => 'Tipo de bodega eliminado con éxito' ]);
        });
        return response()->json($response, $response['http_status_code']);
    }
}
