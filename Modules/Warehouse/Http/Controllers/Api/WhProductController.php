<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\Sort;
use Modules\Warehouse\Filters\WhProduct\FiltersWhProductSearch;
use Modules\Warehouse\Filters\WhProduct\FiltersWhProductType;
use Modules\Warehouse\Http\Requests\WhProduct\UploadLogoWhProductRequest;
use Modules\Warehouse\Services\WhProduct\UploadLogoWhProductService;
use Modules\Warehouse\Services\WhProduct\CrudWhProductService;
use Modules\Warehouse\Filters\WhProduct\FiltersWhProductTypes;
use Modules\Warehouse\Filters\WhProduct\FiltersWhProductFamily;
use Modules\Warehouse\Filters\WhProduct\FiltersWhProductTag;
use Modules\Warehouse\Filters\WhProduct\FiltersWhProductFamilies;
use Modules\Warehouse\Filters\WhProduct\FiltersWhProductSubFamilies;
use Modules\Warehouse\Filters\WhProduct\FiltersWhProductCriticalStock_ByWarehouse;
use Modules\Warehouse\Sorts\WhProduct\WhProduct_SalePriceSort;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Http\Requests\WhProduct\SuggestCodeRequest;
use Modules\Warehouse\Services\WhProduct\SuggestCodeService;
use Modules\Warehouse\Services\WhProduct\MassiveMarginPriceProductService;
use Modules\Warehouse\Http\Requests\WhProduct\MassiveMarginPriceProductRequest;
use Modules\Warehouse\Filters\WhProduct\FiltersWhProductUpcCode;
use Modules\Warehouse\Filters\WhProduct\FiltersWhProductIsConsumable;
use Modules\Warehouse\Services\WhProduct\DeleteWhProductService;

class WhProductController extends Controller
{

    /** @var UploadLogoWhProductService $uploadLogoWhProductService */
    private $uploadLogoWhProductService;

    /** @var CrudWhProductService $crudWhProductService */
    private $crudWhProductService;

    /** @var SuggestCodeService $suggestCodeService */
    private $suggestCodeService;
    /** @var MassiveMarginPriceProductService $massiveMarginPriceProductService */
    private $massiveMarginPriceProductService;
    /** @var DeleteWhProductService $deleteWhProductService */
    private $deleteWhProductService;

    public function __construct(
        UploadLogoWhProductService $uploadLogoWhProductService,
        CrudWhProductService $crudWhProductService,
        SuggestCodeService $suggestCodeService,
        MassiveMarginPriceProductService $massiveMarginPriceProductService,
        DeleteWhProductService $deleteWhProductService
    )
    {
        $this->uploadLogoWhProductService = $uploadLogoWhProductService;
        $this->crudWhProductService = $crudWhProductService;
        $this->suggestCodeService = $suggestCodeService;
        $this->massiveMarginPriceProductService = $massiveMarginPriceProductService;
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
        $query =  QueryBuilder::for(WhProduct::where('wh_product.flag_delete', 0))
                                ->allowedIncludes('wh_item', 'wh_pack', 'wh_packing', 'wh_promo', 'wh_subfamily', 'audit_historic_prices',
                                                  'pch_detail_purchase_debit_notes', 'pch_detail_purchase_invoices', 'pch_detail_purchase_credit_notes',
                                                  'pch_detail_purchase_quotations', 'pos_detail_employee_sales', 'pos_detail_internal_consumptions',
                                                  'pos_detail_sales', 'pos_manual_discounts', 'sl_change_sale_prices', 'sl_detail_list_prices.sl_list_price',
                                                  'sl_detail_sale_credit_notes', 'sl_detail_sale_debit_notes', 'sl_detail_sale_invoices', 'sl_detail_sale_quotations',
                                                  'sl_detail_sale_tickets', 'sl_offers', 'sl_wholesale_discounts', 'wh_detail_dispatch_guides', 'wh_detail_orderers',
                                                  'wh_detail_product_receptions', 'wh_detail_sale_notes', 'wh_detail_transfer_between_warehouses', 'wh_packs',
                                                  'wh_items', 'wh_packings', 'wh_promos', 'wh_stock_movements', 'wh_tags', 'wh_warehouses_primary',
                                                  'wh_product_upc_code')
                                ->allowedAppends('sale_prices', 'composition', 'stocks', 'discounts', 'virtual_offer_price', 'sale_price_by_branch_office', 
                                                 'branch_offices', 'critical_stock_by_warehouse')
                                ->allowedFilters(
                                    Filter::custom('search', FiltersWhProductSearch::class),
                                    Filter::custom('critical_stock_by_warehouse', FiltersWhProductCriticalStock_ByWarehouse::class),
                                    Filter::custom('wh_family_id', FiltersWhProductFamily::class),
                                    Filter::custom('wh_families_id', FiltersWhProductFamilies::class),
                                    Filter::custom('wh_subfamilies_id', FiltersWhProductSubFamilies::class),
                                    Filter::custom('tags_id', FiltersWhProductTag::class),
                                    Filter::custom('upc_code', FiltersWhProductUpcCode::class),
                                    'internal_code',
                                    'name',
                                    Filter::exact('is_salable'),
                                    Filter::exact('wh_subfamily_id'),
                                    Filter::custom('type', FiltersWhProductType::class),
                                    Filter::custom('types', FiltersWhProductTypes::class), // Ej: filter[types]=pack,promo  <-- return pack and promos, not item or packing
                                    Filter::custom('is_consumable', FiltersWhProductIsConsumable::class) // Ej: filter[types]=pack,promo  <-- return pack and promos, not item or packing
                                )
                                ->defaultSort('updated_at')
                                ->allowedSorts(
                                    'id', 
                                    'name', 
                                    'alias_name', 
                                    'internal_code', 
                                    'created_at', 
                                    'updated_at'
                                    // Sort::custom('sale_price', WhProduct_SalePriceSort::class)
                                );

        // Filter for append function sale_price_by_branch_office (getSalePriceByBranchOfficeAttribute df WhProduct)
        if($request->g_branch_office_id)
        {
            $gBranchOfficeId = $request->g_branch_office_id;
            if(! isInt($gBranchOfficeId)) $gBranchOfficeId = -1;
            WhProduct::$gFilterGBranchOffice = $gBranchOfficeId;  // this is a BAD Practice :(
        }

        // Filter primary warehouse of product, by branch office
        if($request->g_branch_office_id &&
           isset($request->include)  &&
           strpos($request->include, 'wh_warehouses_primary') !== false)
        {
            $gBranchOfficeId = $request->g_branch_office_id;

            $query->with(['whWarehousesPrimary' => function($query) use ($gBranchOfficeId) {
                $query->where('wh_product_primary_wh_warehouse.g_branch_office_id', $gBranchOfficeId);
            }]);
        }

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return QueryBuilder::for(WhProduct::where('id', $idWhProduct))
                            ->allowedIncludes('wh_item', 'wh_pack', 'wh_packing', 'wh_promo', 'wh_subfamily', 'audit_historic_prices',
                            'pch_detail_purchase_debit_notes', 'pch_detail_purchase_invoices', 'pch_detail_purchase_credit_notes',
                            'pch_detail_purchase_quotations', 'pos_detail_employee_sales', 'pos_detail_internal_consumptions',
                            'pos_detail_sales', 'pos_manual_discounts', 'sl_change_sale_prices', 'sl_detail_list_prices',
                            'sl_detail_sale_credit_notes', 'sl_detail_sale_debit_notes', 'sl_detail_sale_invoices', 'sl_detail_sale_quotations',
                            'sl_detail_sale_tickets', 'sl_offers', 'sl_wholesale_discounts', 'wh_detail_dispatch_guides', 'wh_detail_orderers',
                            'wh_detail_product_receptions', 'wh_detail_sale_notes', 'wh_detail_transfer_between_warehouses', 'wh_packs',
                            'wh_items', 'wh_packings', 'wh_promos', 'wh_stock_movements', 'wh_tags',
                            'wh_product_upc_code')
                            ->allowedAppends('sale_prices', 'stocks', 'composition', 'discounts', 'virtual_offer_price', 'sale_price_by_branch_office', 'branch_offices')
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
     * Suggest Internal Code
     *
     * @param SuggestCodeRequest $request
     * @return void
     */
    public function suggestInternalCode(SuggestCodeRequest $request)
    {
        $suggestedCode = $this->suggestCodeService->suggestInternalCode($request);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhProduct  $whProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhProduct $whProduct)
    {
        //
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
