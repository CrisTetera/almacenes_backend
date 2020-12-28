<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlOfferPos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Illuminate\Support\Facades\DB;

// Services
use Modules\Sale\Services\SlOfferPos\CrudSlOfferService;
use Modules\Sale\Services\SlOfferPos\CheckExistSlOfferService;
use Modules\Sale\Services\SlOfferPos\MassiveCreateSlOfferService;
use Modules\Sale\Services\SlOfferPos\MassiveEditSlOfferService;
use Modules\Sale\Services\SlOfferPos\MassiveDeleteSlOfferService;

// Request
use Modules\Sale\Http\Requests\SlOfferPos\CreateOfferRequest;
use Modules\Sale\Http\Requests\SlOfferPos\EditOfferRequest;
use Modules\Sale\Http\Requests\SlOfferPos\CheckExistSlOfferRequest;
use Modules\Sale\Http\Requests\SlOfferPos\MassiveCreateSlOfferRequest;
use Modules\Sale\Http\Requests\SlOfferPos\MassiveEditSlOfferRequest;
use Modules\Sale\Http\Requests\SlOfferPos\MassiveDeleteSlOfferRequest;
// Filters
use Modules\Sale\Filters\SlOfferPos\FiltersActiveSlOffer;
use Modules\Sale\Filters\SlOfferPos\FiltersSlOfferUpcCode;
use Modules\Sale\Filters\SlOfferPos\FiltersSlOfferFamily;
use Modules\Sale\Filters\SlOfferPos\FiltersSlOfferSubFamily;
use Modules\Sale\Filters\SlOfferPos\FiltersSlOfferTag;


class SlOfferPosController extends Controller
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
        $query =  QueryBuilder::for(SlOfferPos::where('sl_offer_pos.flag_delete', 0))
                        ->allowedIncludes(
                            'wh_product.wh_subfamily_pos.wh_family_pos',
                            'wh_product.wh_subfamily_pos',
                            'wh_product.wh_item_pos',
                            'wh_product.wh_pack_pos',
                            'wh_product.wh_promo_pos'
                        )
                        ->allowedAppends('name_product', 'upc')
                        ->allowedFilters(
                            Filter::exact('wh_product_id'),
                            Filter::custom('is_active', FiltersActiveSlOffer::class),
                            Filter::scope('starts_after_or_equals'),
                            Filter::scope('ends_before_or_equals'),
                            // filter for products
                            Filter::custom('upc', FiltersSlOfferUpcCode::class),
                            Filter::custom('wh_family_id', FiltersSlOfferFamily::class),
                            Filter::custom('wh_subfamily_id', FiltersSlOfferSubFamily::class),
                            Filter::custom('tags_id', FiltersSlOfferTag::class)
                        )
                        ->defaultSort('sl_offer_pos.updated_at')
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
     * @param  CreateOfferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOfferRequest $request)
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
        return QueryBuilder::for(SlOfferPos::where('id', $idSlOffer))
                        ->allowedIncludes(
                            'wh_product.wh_subfamily_pos',
                            'wh_product.wh_item_pos',
                            'wh_product.wh_pack_pos',
                            'wh_product.wh_promo_pos'
                        )->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditOfferRequest  $request
     * @param  integer  $idSlOffer
     * @return \Illuminate\Http\Response
     */
    public function update(EditOfferRequest $request, $idSlOffer)
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
