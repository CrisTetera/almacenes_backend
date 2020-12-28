<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlOffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Illuminate\Support\Facades\DB;

// Services
use Modules\Sale\Services\SlOffer\CrudSlOfferService;
use Modules\Sale\Services\SlOffer\CheckExistSlOfferService;
use Modules\Sale\Services\SlOffer\MassiveCreateSlOfferService;
use Modules\Sale\Services\SlOffer\MassiveEditSlOfferService;
use Modules\Sale\Services\SlOffer\MassiveDeleteSlOfferService;

// Request
use Modules\Sale\Http\Requests\SlOffer\CreateSlOfferRequest;
use Modules\Sale\Http\Requests\SlOffer\EditSlOfferRequest;
use Modules\Sale\Http\Requests\SlOffer\CheckExistSlOfferRequest;
use Modules\Sale\Http\Requests\SlOffer\MassiveCreateSlOfferRequest;
use Modules\Sale\Http\Requests\SlOffer\MassiveEditSlOfferRequest;
use Modules\Sale\Http\Requests\SlOffer\MassiveDeleteSlOfferRequest;
// Filters
use Modules\Sale\Filters\SlOffer\FiltersActiveSlOffer;
use Modules\Sale\Filters\SlOffer\FiltersSlOfferUpcCode;
use Modules\Sale\Filters\SlOffer\FiltersSlOfferFamily;
use Modules\Sale\Filters\SlOffer\FiltersSlOfferSubFamily;
use Modules\Sale\Filters\SlOffer\FiltersSlOfferTag;


class SlOfferController extends Controller
{

    /** @var CrudSlOfferService $crudSlOfferService */
    private $crudSlOfferService;

    public function __construct(CrudslOfferService $crudSlOfferService)
    {
        $this->crudSlOfferService = $crudSlOfferService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlOffer::where('sl_offer.flag_delete', 0))
                        ->allowedIncludes(
                            'g_branch_office',
                            'wh_product.wh_subfamily.wh_family',
                            'wh_product.wh_item',
                            'wh_product.wh_pack',
                            'wh_product.wh_packing',
                            'wh_product.wh_promo'
                        )
                        ->allowedAppends('name_product', 'upc_code_product')
                        ->allowedFilters(
                            Filter::exact('g_branch_office_id'),
                            Filter::exact('wh_product_id'),
                            Filter::custom('is_active', FiltersActiveSlOffer::class),
                            Filter::scope('starts_after_or_equals'),
                            Filter::scope('ends_before_or_equals'),
                            // filter for products
                            Filter::custom('upc_code', FiltersSlOfferUpcCode::class),
                            Filter::custom('wh_family_id', FiltersSlOfferFamily::class),
                            Filter::custom('wh_subfamily_id', FiltersSlOfferSubFamily::class),
                            Filter::custom('tags_id', FiltersSlOfferTag::class)
                        )
                        ->defaultSort('updated_at')
                        ->allowedSorts('name', 'offer_price', 'init_datetime', 'finish_datetime');
                        

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
     * @param  CreateSlOfferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSlOfferRequest $request)
    {
        $response = $this->crudSlOfferService->store($request);
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
    public function show($idSlOffer)
    {
        return QueryBuilder::for(SlOffer::where('id', $idSlOffer))
                        ->allowedIncludes(
                            'g_branch_office',
                            'wh_product.wh_subfamily',
                            'wh_product.wh_item',
                            'wh_product.wh_pack',
                            'wh_product.wh_packing',
                            'wh_product.wh_promo'
                        )->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditSlOfferRequest  $request
     * @param  integer  $idSlOffer
     * @return \Illuminate\Http\Response
     */
    public function update(EditSlOfferRequest $request, $idSlOffer)
    {
        $response = $this->crudSlOfferService->update($idSlOffer, $request);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage. (logically)
     *
     * @param  integer  $idSlOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy($idSlOffer)
    {
        $response = $this->crudSlOfferService->delete($idSlOffer);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Check if WhProducts Requested have a Active SlOffer 
     * 
     * @param  CheckSlOfferRequest  $request
     */
    public function checkExistSlOffer(CheckExistSlOfferRequest  $request)
    {
        $checkExistSlOfferService = new CheckExistSlOfferService();
        $response = $checkExistSlOfferService->checkExistSlOffer($request);

        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }

        return response()->json($response, $response['http_status_code']);
    } // end function

    /**
     * Create massive SlOffer of WhProduct specified
     * 
     * @param  MassiveCreateSlOfferRequest  $request
     * @return string Is a JSON string response
     */
    public function massiveCreateOffer(MassiveCreateSlOfferRequest $request)
    {
        $massiveCreateSlOfferService = new MassiveCreateSlOfferService();
        $response = $massiveCreateSlOfferService->massiveCreateSlOffer($request);

        if ($response['status'] === 'success') {
            return response()->json($response, 201);
        }

        return response()->json($response, $response['http_status_code']);
    } // end function

    /**
     * Edit massive SlOffer of WhProduct specified
     * 
     * @param  MassiveEditSlOfferRequest  $request
     * @return string Is a JSON string response
     */
    public function massiveEditOffer(MassiveEditSlOfferRequest $request)
    {
        $massiveEditSlOfferService = new MassiveEditSlOfferService();
        $response = $massiveEditSlOfferService->massiveEditSlOffer($request);

        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }

        return response()->json($response, $response['http_status_code']);
    } // end function

    /**
     * Delete massive SlOffer of WhProduct specified
     * 
     * @param  MassiveDeleteSlOfferRequest  $request     *
     * @return string Is a JSON string response
     */
    public function massiveDeleteOffer(MassiveDeleteSlOfferRequest $request)
    {
        $massiveDeleteSlOfferService = new MassiveDeleteSlOfferService();
        $response = $massiveDeleteSlOfferService->massiveDeleteSlOffer($request);

        if ($response['status'] === 'success') {
            return response()->json($response, 201);
        }

        return response()->json($response, $response['http_status_code']);
    } // end function


}
