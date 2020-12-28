<?php

namespace Modules\Warehouse\Http\Controllers\Api;


use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhProductPos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\Sort;
use Modules\Warehouse\Filters\WhProductPos\FiltersWhProductSearch;
use Modules\Warehouse\Filters\WhProductPos\FiltersWhProductType;
use Modules\Warehouse\Http\Requests\WhProductPos\UploadLogoWhProductRequest;
use Modules\Warehouse\Services\WhProductPos\UploadLogoWhProductService;
use Modules\Warehouse\Services\WhProductPos\CrudWhProductService;
use Modules\Warehouse\Filters\WhProductPos\FiltersWhProductTypes;
use Modules\Warehouse\Filters\WhProductPos\FiltersWhProductFamily;
use Modules\Warehouse\Filters\WhProductPos\FiltersWhProductTag;
use Modules\Warehouse\Filters\WhProductPos\FiltersWhProductFamilies;
use Modules\Warehouse\Filters\WhProductPos\FiltersWhProductSubFamilies;
use Modules\Warehouse\Sorts\WhProductPos\WhProduct_SalePriceSort;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Services\WhProductPos\SuggestCodeService;
use Modules\Warehouse\Filters\WhProductPos\FiltersWhProductUpcCode;
use Modules\Warehouse\Services\WhProductPos\DeleteWhProductService;
use Modules\Warehouse\Http\Requests\WhProductPos\CreateProductRequest;
use Modules\Warehouse\Http\Requests\WhProductPos\EditProductRequest;

class WhProductPosController extends Controller
{
    /** @var UploadLogoWhProductService $uploadLogoWhProductService */
    private $uploadLogoWhProductService;

    /** @var CrudWhProductService $crudWhProductService */
    private $crudWhProductService;

    /** @var SuggestCodeService $suggestCodeService */
    private $suggestCodeService;
    /** @var DeleteWhProductService $deleteWhProductService */
    private $deleteWhProductService;

    public function __construct(
        UploadLogoWhProductService $uploadLogoWhProductService,
        CrudWhProductService $crudWhProductService,
        SuggestCodeService $suggestCodeService,
        DeleteWhProductService $deleteWhProductService
    )
    {
        $this->uploadLogoWhProductService = $uploadLogoWhProductService;
        $this->crudWhProductService = $crudWhProductService;
        $this->suggestCodeService = $suggestCodeService;
        $this->deleteWhProductService = $deleteWhProductService;
    }

    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhProductPos::where('flag_delete', 0))
                                ->allowedIncludes('wh_item_pos', 'wh_pack_pos', 'wh_promo_pos', 'wh_subfamily_pos',
                                'pos_detail_pos', 'sl_change_price_list_pos', 'sl_price_list_pos',
                                'sl_offers', 'sl_scheme_discounts_pos',
                                'wh_packs_pos', 'wh_items', 'wh_promos_pos', 'wh_stock_movements_pos', 'wh_tags')
                                ->allowedAppends('sale_price','composition' ,'stocks','stock', 'discounts','have_decimal_quantity')
                                ->allowedFilters(
                                    Filter::custom('search', FiltersWhProductSearch::class),
                                    Filter::custom('wh_family_id', FiltersWhProductFamily::class),
                                    Filter::custom('wh_families_id', FiltersWhProductFamilies::class),
                                    Filter::custom('wh_subfamilies_id', FiltersWhProductSubFamilies::class),
                                    Filter::custom('tags_id', FiltersWhProductTag::class),
                                    Filter::custom('upc', FiltersWhProductUpcCode::class),
                                    'name',
                                    Filter::custom('type', FiltersWhProductType::class),
                                    Filter::custom('types', FiltersWhProductTypes::class) // Ej: filter[types]=pack,promo  <-- return pack and promos, not item or packing
                                )
                                ->defaultSort('updated_at')
                                ->allowedSorts(
                                    'id', 
                                    'name',
                                    'upc', 
                                    'created_at', 
                                    'updated_at'
                                    // Sort::custom('sale_price', WhProduct_SalePriceSort::class)
                                );

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        else {
            $data = $query->paginate($request->limit);
            return $data;
        }
    }

    public function store(CreateProductRequest $request){
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->crudWhProductService->store($request,1);
            return CustomResponse::created($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }
    
    /**
     * Upload product logo
     *
     * @param integer $idWhProduct
     * @param  UploadLogoWhProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadLogo($idWhProduct, UploadLogoWhProductRequest $request)
    {
        $response = $this->uploadLogoWhProductService->upload($idWhProduct, $request);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }
    /**
    * Display the specified resource.
    *
    * @param  int $idWhProduct
    * @return \Illuminate\Http\Response
    */
    public function show($idWhProduct)
    {
        return QueryBuilder::for(WhProductPos::where('id', $idWhProduct))
                            ->allowedIncludes('wh_item_pos', 'wh_pack_pos', 'wh_promo_pos', 'wh_subfamily_pos',
                            'pos_detail_pos', 'sl_change_price_list', 'sl_price_list_pos',
                            'sl_offers', 'sl_scheme_discounts_pos',
                            'wh_packs_pos', 'wh_items_pos', 'wh_promos_pos', 'wh_stock_movements_pos', 'wh_tags')
                            ->allowedAppends('sale_price', 'composition','stocks','stock','discounts','have_decimal_quantity')
                            ->allowedFilters(
                                Filter::custom('search', FiltersWhProductSearch::class),
                                Filter::custom('wh_family_id', FiltersWhProductFamily::class),
                                Filter::custom('wh_families_id', FiltersWhProductFamilies::class),
                                Filter::custom('wh_subfamilies_id', FiltersWhProductSubFamilies::class),
                                Filter::custom('tags_id', FiltersWhProductTag::class),
                                Filter::custom('upc', FiltersWhProductUpcCode::class),
                                'name',
                                Filter::custom('type', FiltersWhProductType::class),
                                Filter::custom('types', FiltersWhProductTypes::class) // Ej: filter[types]=pack,promo  <-- return pack and promos, not item or packing
                            )
                            ->first();
    }

    /**
     * Suggest UPC Code
     *
     * @return void
     */
    public function suggestUpcCode()
    {
        $suggestedCode = $this->suggestCodeService->suggestUpcCode();
        return CustomResponse::ok(['suggested_code' => $suggestedCode]);
    }

    
    /**
     * Massive Margin Update
     *
     * @param MassiveMarginPriceProductRequest $request
     * @return Response
     */
    public function massiveMarginUpdate(MassiveMarginPriceProductRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
           $this->massiveMarginPriceProductService->update($request);
           return CustomResponse::ok(['message' => 'Actualizado con éxito']);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  $wh_product_id
     * @param  EditProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(EditProductRequest $request, $wh_product_id)
    {
        $response = DB::transaction(function() use ($wh_product_id, &$request) {
            $resp = $this->crudWhProductService->update($request, $wh_product_id);
            return CustomResponse::ok($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $idWhProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($idWhProduct)
    {
        $response = DB::transaction(function() use ($idWhProduct) {
            $resp = $this->deleteWhProductService->delete($idWhProduct);
            return CustomResponse::ok(['message' => 'Eliminado con éxito']);
        });
        return response()->json($response, $response['http_status_code']);
    }
}
