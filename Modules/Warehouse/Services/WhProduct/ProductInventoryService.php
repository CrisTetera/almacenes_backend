<?php

namespace Modules\Warehouse\Services\WhProduct;

use Modules\Warehouse\Entities\WhProduct;

class ProductInventoryService
{

    /**
     * Group Item composition from many products into a list.
     * Ex.
     * $productIds = [{ id: 1, quantity: 20 }, ...]
     *      => [{Item A: 20, Item B: 40}, { Item A: 30 }, { Item C: 60 } ]
     * groups to:
     * [{ Item A: 50, Item B: 40, Item C: 60}]
     *
     * Item's array include item_id, item_quantity and item_name
     *
     * @return array
     */
    public function getGroupedItems($products = [])
    {
        $groupedItems = [];
        foreach($products as $product) {
            $composition = WhProduct::find($product['id'])->getCompositionAttribute();
            if ( count($composition) > 0 )
            {
                if ($composition['type'] === 'item'){
                    $groupedItems = $this->groupItem($groupedItems, $composition, $product['quantity']);
                } else if ($composition['type'] === 'pack') {
                    $groupedItems = $this->groupPack($groupedItems, $composition, $product['quantity']);
                } else if ($composition['type'] === 'promo') {
                    $groupedItems = $this->groupPromo($groupedItems, $composition, $product['quantity']);
                } else if ($composition['type'] === 'packing') {
                    $groupedItems = $this->groupPacking($groupedItems, $composition, $product['quantity']);
                }
            }
        }
        return $groupedItems;
    }

    /**
     * Attach item to grouped items (add if it's new, or sum quantity if already exists)
     *
     * @param array $groupedItems
     * @param array $itemComposition
     * @param integer quantity times to group
     * @return array
     */
    private function groupItem($groupedItems = [], $itemComposition, $quantity = 1)
    {
        $index = array_search( $itemComposition['item_id'], array_column($groupedItems, 'item_id') );
        if ( $index === false ) {
            array_push($groupedItems, [
                'item_id' => $itemComposition['item_id'],
                'item_name' => $itemComposition['item_name'],
                'item_quantity' => $itemComposition['quantity'] * $quantity
            ]);
        } else {
            $groupedItems[$index]['item_quantity'] += $itemComposition['quantity'] * $quantity;
        }
        return $groupedItems;
    }

    /**
     * Attach pack's item to grouped items
     *
     * @param array $groupedItems
     * @param array $packComposition
     * @param integer quantity times to group
     * @return array
     */
    private function groupPack($groupedItems = [], $packComposition, $quantity = 1)
    {
        return $this->groupItem($groupedItems, $packComposition, $quantity);
    }

    /**
     * Attack promo's item to grouped items
     *
     * @param array $groupedItems
     * @param array $promoComposition
     * @param integer quantity times to group
     * @return array
     */
    private function groupPromo($groupedItems = [], $promoComposition, $quantity = 1)
    {
        foreach($promoComposition['composition'] as $composition) {
            $quantityRow = $quantity * $composition['quantity_in_promo'];
            if ($composition['type'] === 'pack') {
                $groupedItems = $this->groupPack($groupedItems, $composition, $quantityRow);
            } else if ($composition['type'] === 'item') {
                $groupedItems = $this->groupItem($groupedItems, $composition, $quantityRow);
            }
        }
        return $groupedItems;
    }

    /**
     * Attack packing's item to grouped items
     *
     * @param array $groupedItems
     * @param array $packingComposition
     * @return array
     */
    private function groupPacking($groupedItems = [], $packingComposition, $quantity = 1)
    {
        $quantity = $quantity * $packingComposition['quantity'];
        $type = $packingComposition['composition']['type'];
        if ( $type === 'promo' ) {
            $groupedItems = $this->groupPromo($groupedItems, $packingComposition['composition'], $quantity);
        } else if ( $type === 'pack') {
            $groupedItems = $this->groupPack($groupedItems, $packingComposition['composition'], $quantity);
        } else if ($type === 'item') {
            $groupedItems = $this->groupItem($groupedItems, $packingComposition['composition'], $quantity);
        }
        return $groupedItems;
    }

}
