<?php
namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Warehouse\Entities\WhFamilyPos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Warehouse\Http\Requests\WhFamilyPos\CreateFamilyRequest;
use Modules\Warehouse\Services\WhFamilyPos\CrudWhFamilyService;
use Modules\Warehouse\Http\Requests\WhFamilyPos\EditFamilyRequest;
use Modules\Warehouse\Filters\WhFamilyPos\FiltersWhFamilySearch;

class WhFamilyPosController extends Controller
{

    /** @var CrudWhFamilyService $crudWhFamilyService */
    private $crudWhFamilyService;

    public function __construct(CrudWhFamilyService $crudWhFamilyService)
    {
        $this->crudWhFamilyService = $crudWhFamilyService;
    }

    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhFamilyPos::where('flag_delete', 0))
                                ->allowedIncludes('wh_subfamilies')
                                ->allowedFilters(
                                    Filter::exact('id'),
                                    Filter::custom('search', FiltersWhFamilySearch::class),
                                    'family'
                                )
                                ->defaultSort('updated_at')
                                ->allowedSorts('id', 'family');
                                

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
     * @param  \Modules\Warehouse\Http\Requests\WhFamilyPos\CreateFamilyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFamilyRequest $request)
    {
        // dump($request->family);
        $response =$this->crudWhFamilyService->store($request);
        if ($response['status'] === 'success') {
            return response()->json($response, 201);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /**
    * Display the specified resource.
    *
    * @param  int $idWhFamily
    * @return \Illuminate\Http\Response
    */
    public function show($idWhFamily)
    {
        return QueryBuilder::for(WhFamilyPos::where('id', $idWhFamily))
                            ->allowedIncludes('wh_subfamilies')
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Warehouse\Http\Requests\WhFamilyPos\EditFamilyRequest  $request
     * @param  \Modules\Warehouse\Entities\WhFamilyPos  $idWhFamily
     * @return \Illuminate\Http\Response
     */
    public function update(EditFamilyRequest $request, $idWhFamily)
    {
        $response = $this->crudWhFamilyService->update($idWhFamily, $request);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage. (logically)
     *
     * @param  integer  $idWhFamily
     * @return \Illuminate\Http\Response
     */
    public function destroy($idWhFamily)
    {
        $response = $this->crudWhFamilyService->delete($idWhFamily);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }
}
