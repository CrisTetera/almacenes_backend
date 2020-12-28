<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlCustomerPos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Sale\Http\Requests\SlCustomerPos\CreateSlCustomerRequest;
use Modules\Sale\Services\SlCustomerPos\CrudSlCustomerService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Response\CustomResponse;
use Modules\Sale\Http\Requests\SlCustomerPos\EditSlCustomerRequest;
use Illuminate\Support\Facades\DB;
use Modules\Sale\Services\SlCustomerPos\SearchCustomerService;
use Modules\Sale\Filters\SlCustomerPos\FiltersSlCustomerSearch;
use Modules\Sale\Entities\SlInvoicePos;
use Modules\Sale\Filters\SlCustomerPos\FiltersSlCustomerIsCompany;

class SlCustomerPosController extends Controller
{
    /** @var CrudSlCustomerService $crudSlCustomerService */
    private $crudSlCustomerService;

    /** @var SearchCustomerService $searchCustomerService */
    private $searchCustomerService;

    /**
     * Constructor
     *
     * @param CrudSlCustomerService $crudSlCustomerService
     */
    function __construct(
        CrudSlCustomerService $crudSlCustomerService,
        SearchCustomerService $searchCustomerService
    )
    {
        $this->crudSlCustomerService = $crudSlCustomerService;
        $this->searchCustomerService = $searchCustomerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlCustomerPos::where('flag_delete', 0))
                            ->allowedIncludes(
                                'business_name')
                            ->allowedFilters(
                                Filter::exact('sl_customer_id'),
                                'rut',
                                'business_name',
                                'alias_name',
                                'commercial_business',
                                Filter::exact('created_at'),
                                Filter::exact('updated_at'),
                                Filter::custom('search', FiltersSlCustomerSearch::class),
                                Filter::custom('is_company', FiltersSlCustomerIsCompany::class)
                            )
                            ->defaultSort('updated_at')
                            ->allowedSorts('updated_at', 'rut', 'business_name', 'alias_name', 'updated_at');
        
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
     * @param  \Illuminate\Http\Requests\SlCustomerPos\CreateSlCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSlCustomerRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->crudSlCustomerService->store($request);
            return CustomResponse::created($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idSlCustomer)
    {
        return QueryBuilder::for(SlCustomerPos::where('id', $idSlCustomer))
                            ->allowedIncludes(
                                'sl_customer_pos'
                            )
                            ->first();
    }

    /**
     * Search customer by rut
     *
     * @param string $rut
     * @return \Illuminate\Http\Response
     */
    public function searchByRut($rut)
    {
        $response = $this->searchCustomerService->searchByRut($rut);
        $customer = $response['customer'];
        if (!$customer) {
            $error = CustomResponse::error(new ModelNotFoundException('Cliente no encontrado'), [], 404);
            return response()->json($error, 404);
        }
        return response()->json($response, 200);
    }

    /*
     * Show purchase history of a customer
     *
     * @param string $rut
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
    public function purchaseHistory($rut, Request $request)
    {
        $customer = SlCustomerPos::where('rut', $rut)->where('flag_delete', false)->first();
        if (!$customer) {
            return CustomResponse::normalError(['message' => "Cliente de rut '$rut' no encontrado"]);
        }
        $query = QueryBuilder::for(
            SlInvoicePos::with('slDetailSaleInvoices.whProductPos')
                        ->where('sl_invoice_pos.flag_delete', false)
                        ->where('sl_invoice_pos.sl_customer_id', $customer->id)
                        ->orderBy('sl_invoice_pos.created_at', 'DESC')
        );

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        return $query->paginate($request->limit);
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  EditSlCustomerRequest  $request
     * @param  integer  $idSlCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(EditSlCustomerRequest $request, $idSlCustomer)
    {
        $response = DB::transaction(function() use ($idSlCustomer, &$request) {
            $resp = $this->crudSlCustomerService->update($idSlCustomer, $request);
            return CustomResponse::ok(['sl_customer_id' => $resp]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $idSlCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy($idSlCustomer)
    {
        $response = DB::transaction(function() use ($idSlCustomer) {
            $resp = $this->crudSlCustomerService->delete($idSlCustomer);
            return CustomResponse::ok(['customer_id' => $resp]);
        });
        return response()->json($response, $response['http_status_code']);
    }
}
