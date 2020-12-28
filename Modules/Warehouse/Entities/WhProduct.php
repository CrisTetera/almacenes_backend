<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Warehouse\Services\WhProduct\ProductInventoryService;
use Modules\Warehouse\Services\WhProduct\ProductStockService;
use Modules\Sale\Entities\SlWholesaleDiscount;
use Modules\Warehouse\Services\WhProductWholesale\ProductWholesaleDiscountService;

/**
 * @property int $id
 * @property int $wh_item_id
 * @property int $wh_pack_id
 * @property int $wh_packing_id
 * @property int $wh_promo_id
 * @property int $wh_subfamily_id
 * @property string $upc_code
 * @property string $internal_code
 * @property string $name
 * @property string $alias_name
 * @property string $description
 * @property string $path_logo
 * @property float $cost_price
 * @property float $gains_margin
 * @property float $minimum_stock
 * @property float $critical_stock
 * @property float $maximum_stock
 * @property int $warranty_days
 * @property boolean $is_repackaged
 * @property boolean $is_tax_free
 * @property boolean $is_salable
 * @property boolean $is_consumable
 * @property boolean $is_seasonal
 * @property boolean $flag_delete
 * @property WhItem $whItem
 * @property WhPack $whPack
 * @property WhPacking $whPacking
 * @property WhPromo $whPromo
 * @property WhSubfamily $whSubfamily
 * @property AuditHistoricPrice[] $auditHistoricPrices
 * @property PchDetailPurchaseDebitNote[] $pchDetailPurchaseDebitNotes
 * @property PchDetailPurchaseInvoice[] $pchDetailPurchaseInvoices
 * @property PchDetailPurchaseCreditNote[] $pchDetailPurchaseCreditNotes
 * @property PchDetailPurchaseQuotation[] $pchDetailPurchaseQuotations
 * @property PosDetailEmployeeSale[] $posDetailEmployeeSales
 * @property PosDetailInternalConsumption[] $posDetailInternalConsumptions
 * @property PosDetailSale[] $posDetailSales
 * @property PosManualDiscount[] $posManualDiscounts
 * @property SlChangeSalePrice[] $slChangeSalePrices
 * @property SlDetailListPrice[] $slDetailListPrices
 * @property SlDetailSaleCreditNote[] $slDetailSaleCreditNotes
 * @property SlDetailSaleDebitNote[] $slDetailSaleDebitNotes
 * @property SlDetailSaleInvoice[] $slDetailSaleInvoices
 * @property SlDetailSaleQuotation[] $slDetailSaleQuotations
 * @property SlDetailSaleTicket[] $slDetailSaleTickets
 * @property SlOffer[] $slOffers
 * @property SlWholesaleDiscount[] $slWholesaleDiscounts
 * @property WhDetailDispatchGuide[] $whDetailDispatchGuides
 * @property WhDetailOrderer[] $whDetailOrderers
 * @property WhDetailProductReception[] $whDetailProductReceptions
 * @property WhDetailSaleNote[] $whDetailSaleNotes
 * @property WhDetailTransferBetweenWarehouse[] $whDetailTransferBetweenWarehouses
 * @property WhPack[] $whPacks
 * @property WhItem[] $whItems
 * @property WhPacking[] $whPackings
 * @property WhPromo[] $whPromos
 * @property WhStockMovement[] $whStockMovements
 * @property WhTag[] $whTags
 */
class WhProduct extends Model
{
    /**
     * Define global filter for slDetailListPrice (filter by g_branch_office_id)
     *
     * @var integer
     */
    public static $gFilterGBranchOffice = 1;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_product';

    public $appends = ['upc_codes'];

    /**
     * @var array
     */
    protected $fillable = [
        'wh_item_id',
        'wh_pack_id',
        'wh_packing_id',
        'wh_promo_id',
        'wh_subfamily_id',
        'upc_code',
        'internal_code',
        'name',
        'alias_name',
        'description',
        'path_logo',
        'cost_price',
        'gains_margin',
        'minimum_stock',
        'critical_stock',
        'maximum_stock',
        'warranty_days',
        'is_repackaged',
        'is_salable',
        'is_consumable',
        'is_seasonal',
        'is_tax_free',
        'flag_delete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whItem()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whPack()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhPack');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whPacking()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhPacking');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whPromo()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhPromo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whSubfamily()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhSubfamily');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whProductUpcCode()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhProductUpcCode');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditHistoricPrices()
    {
        return $this->hasMany('Modules\General\Entities\AuditHistoricPrice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchDetailPurchaseDebitNotes()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchDetailPurchaseDebitNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchDetailPurchaseInvoices()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchDetailPurchaseInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchDetailPurchaseCreditNotes()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchDetailPurchaseCreditNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchDetailPurchaseQuotations()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchDetailPurchaseQuotation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDetailEmployeeSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDetailEmployeeSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDetailInternalConsumptions()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDetailInternalConsumption');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDetailSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDetailSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posManualDiscounts()
    {
        return $this->hasMany('Modules\Pos\Entities\PosManualDiscount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slChangeSalePrices()
    {
        return $this->hasMany('Modules\Sale\Entities\SlChangeSalePrice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailListPrices()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailListPrice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailSaleCreditNotes()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailSaleCreditNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailSaleDebitNotes()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailSaleDebitNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailSaleInvoices()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailSaleInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailSaleQuotations()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailSaleQuotation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailSaleTickets()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailSaleTicket');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slOffers()
    {
        return $this->hasMany('Modules\Sale\Entities\SlOffer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slWholesaleDiscounts()
    {
        return $this->hasMany('Modules\Sale\Entities\SlWholesaleDiscount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailDispatchGuides()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailDispatchGuide');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailOrderers()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailOrderer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailProductReceptions()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailProductReception');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailSaleNotes()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailSaleNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailTransferBetweenWarehouses()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailTransferBetweenWarehouse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whPacks()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhPack');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whItems()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whPackings()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhPacking');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whPromos()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhPromo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whStockMovements()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhStockMovement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function whTags()
    {
        return $this->belongsToMany('Modules\Warehouse\Entities\WhTag', 'wh_tag_wh_product', 'wh_product_id', 'wh_tag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function whWarehousesPrimary()
    {
        return $this->belongsToMany('Modules\Warehouse\Entities\WhWarehouse',
                                    'wh_product_primary_wh_warehouse',
                                    'wh_product_id',
                                    'wh_warehouse_id');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function whWarehousePrimaryOfBranchOffice(/*$idBranchOffice*/)
    {
        $idBranchOffice = 1;
        return $this->belongsToMany('Modules\Warehouse\Entities\WhWarehouse',
                                    'wh_product_primary_wh_warehouse',
                                    'wh_product_id',
                                    'wh_warehouse_id')
                    ->where('wh_product_primary_wh_warehouse.g_branch_office_id', $idBranchOffice);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productDataBranchOffice()
    {
        return $this->belongsToMany('Modules\Warehouse\Entities\WhProductGBranchOffice', 'wh_product_g_branch_office', 'wh_product_id', 'g_branch_office_id')
                    ->withPivot('cost_price', 'gains_margin', 'minimum_stock', 'maximum_stock', 'critical_stock');
    }

    /**
     * Get Upc Codes
     *
     * @return void
     */
    public function getUpcCodesAttribute()
    {
        return $this->whProductUpcCode()->get()->pluck('upc_code');
    }

    /**
     *  Sale Price from Product.
     * TODO: (One from any branch office, change)
     * @return void
     */
    public function getSalePriceAttribute() {
        $obj = $this->slDetailListPrices()
                   ->selectRaw('sl_detail_list_price.sale_price')
                   ->where('sl_detail_list_price.flag_delete', false)
                   ->join('sl_list_price', 'sl_detail_list_price.sl_list_price_id', 'sl_list_price.id')
                   ->where('sl_detail_list_price.flag_delete', false)
                   ->where('sl_list_price.is_active', true)
                   ->get()
                   ->first();

        return $obj ? (int) $obj->sale_price : 0;
    }

    /**
     * Get Sale Price per branch office
     *
     * @return array
     */
    public function getSalePricesAttribute() {
        $arr = $this->slDetailListPrices()
                   ->selectRaw('CAST(sl_detail_list_price.sale_price AS INT) as sale_price, g_branch_office.id as branch_office_id, g_branch_office.address as branch_office_address')
                   ->where('sl_detail_list_price.flag_delete', false)
                   ->join('sl_list_price', 'sl_detail_list_price.sl_list_price_id', 'sl_list_price.id')
                   ->where('sl_detail_list_price.flag_delete', false)
                   ->where('sl_list_price.is_active', true)
                   ->join('g_branch_office', 'sl_list_price.g_branch_office_id', 'g_branch_office.id')
                   ->where('g_branch_office.flag_delete', false)
                   ->get();
        return $arr;
    }

    /**
     * Get Stock from the product in warehouse
     * TODO: Which warehouse? for now the first
     *
     * @param integer $gBranchOfficeId
     * @return void
     */
    public function getStockAttribute($warehouseId) {
        if ($this->wh_item_id) {
            $obj = $this->whItem()
                   ->join('wh_warehouse_item', 'wh_item.id', 'wh_warehouse_item.wh_item_id')
                   ->selectRaw('wh_warehouse_item.wh_item_id, wh_warehouse_item.stock')
                   ->where('wh_warehouse_item.flag_delete', false)
                   ->where('wh_warehouse_item.wh_warehouse_id', $warehouseId)
                   ->join('wh_warehouse', 'wh_warehouse_item.wh_warehouse_id', 'wh_warehouse.id')
                   ->where('wh_warehouse.flag_delete', false)
                   ->get()
                   ->first();
            return $obj ? [(int) $obj->stock] : [0];
        }
        return 0;
    }

    /**
     * Get Stock from the all warehouses
     *
     * @return void
     */
    public function getStocksAttribute() {
        $productInventoryService = new ProductInventoryService();
        $productStockService = new ProductStockService($productInventoryService);

        return $productStockService->getStocks($this->id);
    }

    /**
     * Get Discounts from a product
     *
     * @return void
     */
    public function getDiscountsAttribute() {
        $productWholesaleDiscountService = new ProductWholesaleDiscountService();
        return $productWholesaleDiscountService->getWholesaleDiscount($this);
    }

    /**
     * Return the item composition of the product.
     * Ex.
     * {
     *      type: 'promo'
     *      composition: [
     *          { type: 'item', item_id: 30, quantity: 6 },
     *          { type: 'pack', item_id: 20, quantity: 8 },
     *      ]
     * }
     * @return array
     */
    public function getCompositionAttribute() {
        $obj = [];

        if ($this->wh_item_id) {
            $obj = $this->getItemComposition();
        } else if ($this->wh_pack_id) {
            $obj = $this->getPackComposition();
        } else if ($this->wh_promo_id) {
            $obj = $this->getPromoComposition();
        } else if ($this->wh_packing_id) {
            $obj = $this->getPackingComposition();
        }
        return $obj;
    }

    /**
     * Get Item composition of a item product
     *
     * @return array
     */
    public function getItemComposition() {
        $obj = $this->whItem()
                        ->selectRaw('wh_item.wh_product_id as product_id, wh_item.id as id')
                        ->first();
        return [ 'type' => 'item', 'item_id' => $obj['id'], 'item_product_id' => $obj['product_id'], 'quantity' => 1, 'item_name' => $this->name ];
    }

    /**
     * Get Pack composition of a pack product
     *
     * @return array
     */
    public function getPackComposition() {
        $obj = $this->whPack()
                        ->join('wh_product', 'wh_product.wh_item_id', 'wh_pack.wh_item_id')
                        ->selectRaw('wh_pack.*, wh_pack.id as pack_id, wh_pack.wh_product_id as product_id, wh_pack.wh_item_id as item_id, wh_product.name, wh_product.id as wh_product_id')
                        ->first();
        return [ 'type' => 'pack', 'pack_id' => $obj['pack_id'], 'pack_product_id' => $obj['product_id'], 'item_id' => $obj['item_id'], 'quantity' => floatval($obj['item_quantity']), 'item_name' => $obj['name']  ];
    }

    /**
     * Get Pack composition of a promo product
     *
     * @return array
     */
    public function getPromoComposition() {
        $obj = $this->whPromo('wh_promo')
                        ->join('wh_promo_wh_product_promo as whp_whp', 'whp_whp.wh_promo_id', 'wh_promo.id')
                        ->join('wh_product', 'wh_product.id', 'whp_whp.wh_product_id')
                        ->selectRaw("wh_promo.id as promo_id, wh_product.id as promo_product_id, whp_whp.quantity as quantity_in_promo")
                        ->get();
        // Temp fix for test products:
        if (count($obj) == 0) {
            $obj = $this->whPromo('wh_promo')
                        ->join('wh_promo_wh_product_promo as whp_whp', 'whp_whp.wh_promo_id', 'wh_promo.wh_product_id')
                        ->join('wh_product', 'wh_product.id', 'whp_whp.wh_product_id')
                        ->selectRaw("wh_promo.id as promo_id, wh_product.id as promo_product_id, whp_whp.quantity as quantity_in_promo")
                        ->get();
        }
        if ( count($obj) == 0 ) return [];
        // Find composition for each product inside promo
        $composition = $obj->map(function($el) {
            return array_merge(
                    WhProduct::find($el['promo_product_id'])->getCompositionAttribute(),
                    ['quantity_in_promo' => $el['quantity_in_promo']]
                );
        });
        return [
            'type' => 'promo',
            'promo_id' => $obj[0]->promo_id,
            'composition' => $composition
        ];
    }

    /**
     * Get Packing composition of a packing product
     *
     * @return array
     */
    public function getPackingComposition() {
        $obj = $this->whPacking()
                        ->join('wh_product', 'wh_product.id', 'wh_packing.wh_product_id')
                        ->selectRaw('wh_packing.*, wh_packing.id as pack_id, wh_packing.wh_product_id as product_id, wh_packing.wh_product_content_id as product_content_id, wh_product.name, wh_product.id as wh_product_id')
                        ->first();
        $obj = [ 'type' => 'packing', 'packing_id' => $obj['pack_id'], 'packing_product_id' => $obj['product_id'], 'packing_product_content_id' => $obj['product_content_id'], 'quantity' => floatval($obj['quantity_product']), 'packing_product_name' => $obj['name']  ];
        $obj['composition'] = WhProduct::find($obj['packing_product_content_id'])->getCompositionAttribute();
        return $obj;
    }

    /**
     * Get virtual_offer_price attribute (valid for massive create SlOffer)
     *
     * @return null
     */
    public function getVirtualOfferPriceAttribute() {
        return null;
    }

    /**
     * Get sale price of product filter bu g_branch_office_id (defined in static var of class $gFilterGBranchOffice)
     *
     * @return int
     */
    public function getSalePriceByBranchOfficeAttribute() {
        $slDetailListPrice = $this->slDetailListPrices()
                                  ->join('sl_list_price', 'sl_detail_list_price.sl_list_price_id', 'sl_list_price.id')
                                  ->where('sl_list_price.g_branch_office_id', self::$gFilterGBranchOffice)
                                  ->where('sl_list_price.is_active', true)
                                  ->where('sl_list_price.flag_delete', false)
                                  ->where('sl_detail_list_price.flag_delete', false)
                                  ->first();

        return isset($slDetailListPrice) ? (int) $slDetailListPrice->sale_price : 0;
    } // end function

    public function getBranchOfficesAttribute()
    {
        return WhProductGBranchOffice::with('gBranchOffice')->whereWhProductId($this->id)->orderBy('g_branch_office_id', 'ASC')->get();
    }

}
