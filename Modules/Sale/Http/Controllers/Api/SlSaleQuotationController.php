<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlSaleQuotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Sale\Services\SlSaleQuotation\GenerateSaleQuotationService;
use Modules\Sale\Services\SlSaleQuotation\GeneratePDFSaleQuotationService;

class SlSaleQuotationController extends Controller
{

    private $generateSaleQuotationService;
    private $generatePDFSaleQuotationService;

    function __construct(
        GenerateSaleQuotationService $generateSaleQuotationService,
        GeneratePDFSaleQuotationService $generatePDFSaleQuotationService
    )
    {
        $this->generateSaleQuotationService = $generateSaleQuotationService;
        $this->generatePDFSaleQuotationService = $generatePDFSaleQuotationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlSaleQuotation::orderBy('id'))
                        ->allowedIncludes(
                            'sl_customer',
                            'sl_detail_sale_quotations.wh_product',
                            'pos_sale_type',
                            'g_user',
                            'g_branch_office'
                        )
                        ->allowedFilters(
                            Filter::exact('sl_customer_id'),
                            Filter::exact('pos_sale_type_id'),
                            Filter::exact('g_user_id'),
                            Filter::exact('g_branch_office_id'),
                            Filter::exact('emission_date'),
                            'number'
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
     * Store a newly sale quotation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->generateSaleQuotationService->store($request);
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
    public function show($idSlSaleQuotation)
    {
        return QueryBuilder::for(SlSaleQuotation::where('id', $idSlSaleQuotation))
                        ->allowedIncludes(
                            'sl_customer',
                            'sl_detail_sale_quotations',
                            'pos_sale_type',
                            'g_user',
                            'g_branch_office'
                        )->first();
    }

    /**
     * Generates PDF od SlSaleQuotation and send this for email to SlCustomer
     *
     * @param integer $idSlSaleQuotation
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($idSlSaleQuotation)
    {
        return $this->generatePDFSaleQuotationService->streamPDF($idSlSaleQuotation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlSaleQuotation  $slSaleQuotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlSaleQuotation $slSaleQuotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlSaleQuotation  $slSaleQuotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlSaleQuotation $slSaleQuotation)
    {
        //
    }
}
