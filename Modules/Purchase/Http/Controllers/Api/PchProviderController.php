<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\Filter;
use Modules\Purchase\Filters\PchProvider\FiltersSearchProvider;
use Modules\Purchase\Http\Requests\PchProvider\CreateProviderRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Purchase\Services\PchProvider\CrudPchProviderService;
use Modules\Purchase\Http\Requests\PchProvider\EditProviderRequest;

class PchProviderController extends Controller
{
    /** @var CrudPchProviderService $crudPchProviderService */
    private $crudPchProviderService;

    public function __construct(
        CrudPchProviderService $crudPchProviderService
    )
    {
        $this->crudPchProviderService = $crudPchProviderService;
    }

    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchProvider::orderBy('id'))
                                ->allowedIncludes('pch_provider_account', 'pch_purchase_invoices', 'pch_purchase_orders',
                                                  'pch_provider_account_banks', 'pch_provider_accounts', 'pch_purchase_quotations')
                                ->allowedFilters([
                                    Filter::custom('search', FiltersSearchProvider::class)
                                ])
                                ->allowedAppends(
                                    'branch_offices'
                                )
                                ->where('flag_delete', 0);

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
     * @param  CreateProviderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProviderRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->crudPchProviderService->store($request);
            return CustomResponse::created($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
    * Display the specified resource.
    *
    * @param  int $idPchProvider
    * @return \Illuminate\Http\Response
    */
    public function show($idPchProvider)
    {
        return QueryBuilder::for(PchProvider::where('id', $idPchProvider))
                            ->allowedIncludes('pch_provider_account', 'pch_purchase_invoices', 'pch_purchase_orders',
                                              'pch_provider_account_banks', 'pch_provider_accounts', 'pch_purchase_quotations')
                            ->allowedAppends(
                                'branch_offices'
                            )
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditProviderRequest  $request
     * @param  int  $idPchProvider
     * @return \Illuminate\Http\Response
     */
    public function update(EditProviderRequest $request, int $idPchProvider)
    {
        $response = DB::transaction(function() use ($idPchProvider, &$request) {
            $resp = $this->crudPchProviderService->update($idPchProvider, $request);
            return CustomResponse::ok(['provider_id' => $resp]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idPchProvider
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $idPchProvider)
    {
        $response = DB::transaction(function() use ($idPchProvider) {
            $resp = $this->crudPchProviderService->delete($idPchProvider);
            return CustomResponse::ok(['provider_id' => $resp]);
        });
        return response()->json($response, $response['http_status_code']);
    }
}
