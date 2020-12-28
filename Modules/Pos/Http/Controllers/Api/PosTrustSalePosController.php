<?php

namespace Modules\Pos\Http\Controllers\Api;

use Modules\Pos\Entities\PosTrustSalePos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Pos\Services\PosSalePos\GenerateTrustSaleService;
use Modules\Pos\Services\PosSalePos\DtePosSaleService;
use Modules\Pos\Services\PosSalePos\PayPosSaleService;
use Modules\Pos\Services\PosSalePos\CancelSaleService;
use Modules\Pos\Services\PosSalePos\ModifySaleService;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Pos\Http\Requests\Pos\PayTrustedSaleRequest;


class PosTrustSalePosController extends Controller
{
    /**  @var GenerateTrustSaleService $generateTrustSaleService */
    private $generateTrustSaleService;
    /** @var PayPosSaleService $payPosSaleService */
    private $payPosSaleService;
    /** @var CancelSaleService $cancelSaleService */
    private $cancelSaleService;
    /**  @var ModifySaleService $modifySaleService */
    private $modifySaleService;

    /**
     * Constructor
     *
     * @param GenerateSaleService $generateSaleService
     * @param PayPosSaleService $payPosSaleService
     * @param CancelSaleService $cancelSaleService
     * @param ModifySaleService $modifySaleService
     */
    function __construct(GenerateTrustSaleService $generateTrustSaleService,
                         PayPosSaleService $payPosSaleService,
                         CancelSaleService $cancelSaleService,
                         ModifySaleService $modifySaleService)
    {
        $this->generateTrustSaleService = $generateTrustSaleService;
        $this->payPosSaleService = $payPosSaleService;
        $this->cancelSaleService = $cancelSaleService;
        $this->modifySaleService = $modifySaleService;
    }

    /** 
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosTrustSalePos::orderBy('id'))
                            ->allowedIncludes(
                                'pos_sale_pos'
                            )
                            ->allowedAppends('pos_detail_pos')
                            ->where('flag_delete', 0);

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        return $query->paginate($request->limit);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idPosSale)
    {
        return QueryBuilder::for(PosTrustSalePos::where('id', $idPosSale))
                            ->allowedIncludes(
                                'pos_sale_pos'
                            )
                            ->allowedAppends('pos_detail_pos')
                            ->first();
    }

    /** 
     * Store a newly sale (vale venta)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->generateTrustSaleService->store($request);
            return CustomResponse::created($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Pay the sale
     *
     * @param  Modules\Pos\Http\Requests\Pos\PayTrustedSaleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function paySale(PayTrustedSaleRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->payPosSaleService->payTrustSale($request);
            return CustomResponse::ok($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /** 
     * Modify the sale
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function modifySale(Request $request)
    {
        $response = $this->modifySaleService->modifySale($request);
        if ($response['status'] === 'success') {
            return response()->json($response, 201);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /** 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosSale  $posSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosSale $posSale)
    {
        //
    }

    /** 
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     **/
    public function destroy($id)
    {
        $response = $this->cancelSaleService->cancelSale($id);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }
}
