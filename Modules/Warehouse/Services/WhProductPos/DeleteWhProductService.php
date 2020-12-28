<?php

namespace Modules\Warehouse\Services\WhProductPos;

use Modules\Warehouse\Entities\WhProductPos;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Entities\WhPromoPos;
use Modules\Warehouse\Entities\WhPackPos;
use Modules\Warehouse\Entities\WhItemPos;
use Modules\Sale\Entities\SlPriceListPos;


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
        $this->deleteIfIsPromo($product);
    }

    private function deleteDetailList(WhProductPos $product)
    {
        SlPriceListPos::where('wh_product_id', $product->id)
                        ->where('flag_delete', false)
                        ->update(['flag_delete' => true]);
    }



    private function deleteIfIsItem(WhProductPos $product)
    {
        if ( $product->wh_item_id ) {
            $item = WhItemPos::where('id', $product->wh_item_id)->first();
            $item->flag_delete = true;
            $item->save();
        }
    }

    private function deleteIfIsPack(WhProductPos $product)
    {
        if ( $product->wh_pack_id ) {
            $pack = WhPackPos::where('id', $product->wh_pack_id)->first();
            $pack->flag_delete = true;
            $pack->save();
        }
    }

    private function deleteIfIsPromo(WhProductPos $product)
    {
        if ( $product->wh_promo_id ) {
            $promo = WhPromoPos::where('id', $product->wh_promo_id)->first();
            $promo->flag_delete = true;
            $promo->save();
        }
    }

    public function checkProduct($idWhProduct)
    {
        $product = WhProductPos::where('id', $idWhProduct)->where('flag_delete', false)->first();
        if (!$product) {
            throw new ValidationException("El producto ($idWhProduct) no existe");
        }
        return $product;
    }
}
