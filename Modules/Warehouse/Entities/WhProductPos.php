<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Warehouse\Services\WhProductPos\ProductInventoryService;
use Modules\Warehouse\Services\WhProductPos\ProductStockService;

class WhProductPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_product_pos';
    
    /**
     * @var array
     */
    protected $fillable = [
        'wh_item_id',
        'wh_pack_id',
        'wh_promo_id',
        'upc',
        'name',
        'description',
        'path_logo',
        'is_tax_free',
        'wh_subfamily_id',
        'cost_price',
        'gains_margin',
        'flag_delete'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDetailPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDetailPos');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whItemPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhItemPos','wh_item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whPackPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhPackPos', 'wh_pack_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whPromoPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhPromoPos','wh_promo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whSubfamilyPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhSubfamilyPos', 'wh_subfamily_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slOffers()
    {
        return $this->hasMany('Modules\Sale\Entities\SlOfferPos','wh_product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slSchemeDiscounts()
    {
        return $this->hasMany('Modules\Sale\Entities\SlSchemeDiscountPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slPriceListPos()
    {
        return $this->hasMany('Modules\Sale\Entities\SlPriceListPos', 'wh_product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slChangePriceListPos()
    {
        return $this->hasMany('Modules\Sale\Entities\SlChangePriceListPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whPacksPos()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhPackPos','wh_product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whItemsPos()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhItemPos', 'wh_product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whPromosPos()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhPromoPos', 'wh_product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whStockMovements()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhStockMovementPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function whTags()
    {
        return $this->belongsToMany('Modules\Warehouse\Entities\WhTagPos', 'wh_tag_wh_product_pos', 'wh_product_id', 'wh_tag_id');
    }

    /**
     *  Sale Price from Product.
     * TODO: (One from any branch office, change)
     * @return void
     */
    public function getSalePriceAttribute() {
        $obj = $this->slPriceListPos()
                   ->selectRaw('sl_price_list_pos.sale_price')
                   ->where('sl_price_list_pos.flag_delete', false)
                   ->get()
                   ->first();

        return $obj ? (int) $obj->sale_price : 0;
    }

    /**
     * Get Stock from the product in warehouse
     * TODO: Which warehouse? for now the first
     *
     * @param integer $gBranchOfficeId
     * @return void
     */
    public function getStocksAttribute($warehouseId) {
        if ($this->wh_item_id) {
            $obj = $this->whItemPos()
                   ->join('wh_item_stock_pos', 'wh_item_pos.id', 'wh_item_stock_pos.wh_item_id')
                   ->selectRaw('wh_item_stock_pos.wh_item_id, wh_item_stock_pos.stock')
                   ->where('wh_item_stock_pos.flag_delete', false)
                   ->where('wh_item_stock_pos.wh_warehouse_id', $warehouseId)
                   ->join('wh_warehouse_pos', 'wh_item_stock_pos.wh_warehouse_id', 'wh_warehouse_pos.id')
                   ->where('wh_warehouse_pos.flag_delete', false)
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
    public function getStockAttribute() {
        $productInventoryService = new ProductInventoryService();
        $productStockService = new ProductStockService($productInventoryService);
        
        return $productStockService->getStocks($this->id);
         
    }
    // /**
    //  * Get Stock from the all warehouses
    //  *
    //  * @return void
    //  */
    // public function getStocksAttribute() {
    //     $productInventoryService = new ProductInventoryService();
    //     $productStockService = new ProductStockService($productInventoryService);
        
    //     if (WhProductPos::where('id',$this->id)->whereNotNull('wh_item_id')->where('flag_delete',0)
    //         ->first()){
    //         return $productStockService->getStock($this->id);
    //     }else{
    //         return 0;
    //     }
        
    // }
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
        } 
        return $obj;
    }

    /**
     * Get Item composition of a item product
     *
     * @return array
     */
    public function getItemComposition() {
        $obj = $this->whItemPos()
                        ->selectRaw('wh_item_pos.wh_product_id as product_id, wh_item_pos.id as id')
                        ->first();
        // dump('item_id ' , $obj['id'], 'item_product_id ' , $obj['product_id'], 'quantity ' , 1, 'item_name ' , $this->name );
        return [ 'type' => 'item', 'item_id' => $obj['id'], 'item_product_id' => $obj['product_id'], 'quantity' => 1, 'item_name' => $this->name ];
    }

    /**
     * Get Pack composition of a pack product
     *
     * @return array
     */
    public function getPackComposition() {
        $obj = $this->whPacksPos()
                        ->join('wh_product_pos', 'wh_product_pos.wh_item_id', 'wh_pack_pos.wh_item_id')
                        ->selectRaw('wh_pack_pos.*, wh_pack_pos.id as pack_id, wh_pack_pos.wh_product_id as product_id, 
                                     wh_pack_pos.wh_item_id as item_id, wh_product_pos.name, wh_product_pos.id as wh_product_id')
                        ->first();
        return [ 'type' => 'pack', 'pack_id' => $obj['pack_id'], 'pack_product_id' => $obj['product_id'], 'item_id' => $obj['item_id'], 'quantity' => floatval($obj['item_quantity']), 'item_name' => $obj['name']  ];
    }

    /**
     * Get virtual_offer_price attribute (valid for massive create SlOffer)
     *
     * @return null
     */
    public function getHaveDecimalQuantityAttribute() {
        $bol =$this->whItemPos($this->id)->select('have_decimal_quantity')->first();
        return $bol['have_decimal_quantity'];
    }

    /**
     * Get Pack composition of a promo product
     *
     * @return array
     */
    public function getPromoComposition() {
        $obj = $this->whPromosPos('wh_promo_pos')
                        ->join('wh_products_on_promo_pos as whp_whp', 'whp_whp.wh_promo_id', 'wh_promo_pos.id')
                        ->join('wh_product_pos', 'wh_product_pos.id', 'whp_whp.wh_product_id')
                        ->selectRaw("wh_promo_pos.id as promo_id, wh_product_pos.id as promo_product_id, 
                                     whp_whp.quantity as quantity_in_promo")
                        ->get();
        // Temp fix for test products:
        if (count($obj) == 0) {
            $obj = $this->whPromosPos('wh_promo_pos')
                        ->join('wh_products_on_promo_pos as whp_whp', 'whp_whp.wh_promo_id', 'wh_promo_pos.wh_product_id')
                        ->join('wh_product_pos', 'wh_product_pos.id', 'whp_whp.wh_product_id')
                        ->selectRaw("wh_promo_pos.id as promo_id, wh_product_pos.id as promo_product_id, whp_whp.quantity as quantity_in_promo")
                        ->get();
        }
        if ( count($obj) == 0 ) return [];
        // Find composition for each product inside promo
        $composition = $obj->map(function($el) {
            return array_merge(
                    WhProductPos::find($el['promo_product_id'])->getCompositionAttribute(),
                    ['quantity_in_promo' => $el['quantity_in_promo']]
                );
        });
        return [
            'type' => 'promo',
            'promo_id' => $obj[0]->promo_id,
            'composition' => $composition
        ];
    }
}
