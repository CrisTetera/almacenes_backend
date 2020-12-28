<?php

namespace Modules\Warehouse\Services\WhProduct;

use Modules\Warehouse\Entities\WhProduct;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Entities\WhPromo;
use Modules\Warehouse\Entities\WhPacking;
use Modules\Warehouse\Entities\WhPack;
use Modules\Warehouse\Entities\WhItem;
use Modules\Sale\Entities\SlDetailListPrice;


class DeleteWhProductService
{
    public function delete($idWhProduct)
    {
        $product = $this->checkProduct($idWhProduct);

        $product->flag_delete = true;
        $product->save();

        $this->deleteDetailList($product);

        $this->deleteIfIsItem($product);
        $this->deleteIfIsPack($product);
        $this->deleteIfIsPacking($product);
        $this->deleteIfIsPromo($product);
    }

    private function deleteDetailList(WhProduct $product)
    {
        SlDetailListPrice::where('wh_product_id', $product->id)
                        ->where('flag_delete', false)
                        ->update(['flag_delete' => true]);
    }

    private function deleteIfIsItem(WhProduct $product)
    {
        if ( $product->wh_item_id ) {
            $item = WhItem::where('id', $product->wh_item_id)->first();
            $item->flag_delete = true;
            $item->save();
        }
    }

    private function deleteIfIsPack(WhProduct $product)
    {
        if ( $product->wh_pack_id ) {
            $pack = WhPack::where('id', $product->wh_pack_id)->first();
            $pack->flag_delete = true;
            $pack->save();
        }
    }

    private function deleteIfIsPacking(WhProduct $product)
    {
        if ( $product->wh_packing_id ) {
            $packing = WhPacking::where('id', $product->wh_packing_id)->first();
            $packing->flag_delete = true;
            $packing->save();
        }
    }

    private function deleteIfIsPromo(WhProduct $product)
    {
        if ( $product->wh_promo_id ) {
            $promo = WhPromo::where('id', $product->wh_promo_id)->first();
            $promo->flag_delete = true;
            $promo->save();
        }
    }

    public function checkProduct($idWhProduct)
    {
        $product = WhProduct::where('id', $idWhProduct)->where('flag_delete', false)->first();
        if (!$product) {
            throw new ValidationException("El producto ($idWhProduct) no existe");
        }
        return $product;
    }
}
