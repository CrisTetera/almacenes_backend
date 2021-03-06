<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Modules\Warehouse\Entities\WhTagPos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Warehouse\Services\WhTagPos\CrudWhTagService;
use Modules\Warehouse\Http\Requests\WhTagPos\CreateTagRequest;
use Modules\Warehouse\Http\Requests\WhTagPos\EditTagRequest;
use Modules\Warehouse\Filters\WhTag\FiltersWhTagSearch;

class WhTagPosController extends Controller
{
    /** @var CrudWhTagService $crudWhTagService */
    private $crudWhTagService;

    public function __construct(CrudWhTagService $crudWhTagService)
    {
        $this->crudWhTagService = $crudWhTagService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhTagPos::where('flag_delete', 0))
                            ->allowedIncludes(
                                'wh_products'
                            )
                            ->allowedFilters(
                                Filter::exact('id'),
                                'tag',
                                'description',
                                Filter::custom('search', FiltersWhTagSearch::class)
                            )
                            ->defaultSort('updated_at')
                            ->allowedSorts('id', 'tag', 'description');

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
     * @param  CreateTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        $response = $this->crudWhTagService->store($request);
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
    public function show($idWhTag)
    {
        return QueryBuilder::for(WhTagPos::where('id', $idWhTag))
                            ->allowedIncludes(
                                'wh_products'
                            )
                            ->first();
    }

/**
     * Update the specified resource in storage.
     *
     * @param  EditTagRequest  $request
     * @param  integer  $idWhTag
     * @return \Illuminate\Http\Response
     */
    public function update(EditTagRequest $request, $idWhTag)
    {
        $response = $this->crudWhTagService->update($idWhTag, $request);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $idWhTag
     * @return \Illuminate\Http\Response
     */
    public function destroy($idWhTag)
    {
        $response = $this->crudWhTagService->delete($idWhTag);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }
}
