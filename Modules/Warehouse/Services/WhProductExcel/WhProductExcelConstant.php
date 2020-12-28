<?php

namespace Modules\Warehouse\Services\WhProductExcel;

class WhProductExcelConstant
{
    public const UPC_CODE               = 0;
    public const INTERNAL_CODE          = 1;
    public const PRODUCT_NAME           = 2;
    public const PRODUCT_ALIAS          = 3;
    public const PRODUCT_DESCRIPTION    = 4;
    public const PRODUCT_WARRANTY_DAYS  = 5;
    public const PRODUCT_IS_REPACKAGED  = 6;
    public const PRODUCT_IS_TAX_FREE    = 7;
    public const PRODUCT_IS_SALABLE     = 8;
    public const PRODUCT_IS_CONSUMABLE  = 9;
    public const PRODUCT_IS_SEASONAL    = 10;
    public const PRODUCT_COST_PRICE     = 11;
    public const PRODUCT_SALE_PRICE     = 12;
    public const PRODUCT_STOCK          = 13;
    public const SCHEMA_DISCOUNT        = 14;
    public const SCHEMA_QUANTITY        = 15;
    public const PRODUCT_TYPE           = 16;
    public const PRODUCT_COMPOSITION    = 17;

    public const PRODUCT_TYPE_ITEM      = 'ITEM';
    public const PRODUCT_TYPE_PACK      = 'PACK';
    public const PRODUCT_TYPE_PROMO     = 'PROMO';
    public const PRODUCT_TYPE_PACKING   = 'PACKING';
}
