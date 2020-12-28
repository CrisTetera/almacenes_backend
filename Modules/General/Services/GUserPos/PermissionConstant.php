<?php

namespace Modules\General\Services\GUserPos;

class PermissionConstant
{
    /**
     * POS + CAJA Permissions
     */
    public const POS_AUTORIZAR_APERTURA_CAJA    = 'autorizar apertura caja';
    public const POS_AUTORIZAR_EGRESO_CAJA      = 'autorizar egreso caja';
    public const POS_AUTORIZAR_INGRESO_CAJA     = 'autorizar ingreso caja';
    public const POS_AUTORIZAR_TICKET_DE_VENTA  = 'autorizar ticket de venta';
    public const POS_AUTORIZAR_ARQUEO_CAJA      = 'autorizar arqueo caja';
    public const POS_AUTORIZAR_NOTA_DE_CREDITO  = 'autorizar nota de credito';
    public const POS_AUTORIZAR_VENTA_A_PERSONAL = 'autorizar venta a personal';
    public const POS_AUTORIZAR_CAMBIO_PRODUCTOS = 'autorizar cambio productos';
    public const POS_AUTORIZAR_ANULACION_DTE    = 'autorizar anulacion boleta o factura';
    public const POS_OPERAR_CAJA                = 'operar caja';
    public const POS_OPERAR_PUNTO_VENTA         = 'operar punto venta';
    public const POS_GET_RESUMEN_COMPLETO_ARQUEO_CAJA   = 'obtener resumen completo arqueo caja';
    public const POS_CERRAR_CAJA                = 'cerrar caja';

    /**
     * POS GROUND
     */
    public const POS_USE_POS_GROUND = 'use POS Ground';

    /**
     * SALE
     */
    // Products permissions
    public const SL_VIEW_ALL_PRODUCTS       = 'view all products';
    public const SL_VIEW_CREATE_PRODUCT     = 'create product';
    public const SL_VIEW_EDIT_PRODUCT       = 'edit product';
    public const SL_VIEW_DELETE_PRODUCT     = 'delete product';
    // Customers permissions
    public const SL_VIEW_ALL_CUSTOMERS      = 'view all customers';
    public const SL_VIEW_CREATE_CUSTOMER    = 'create customer';
    public const SL_VIEW_EDIT_CUSTOMER      = 'edit customer';
    public const SL_VIEW_DELETE_CUSTOMER    = 'delete customer';
    // Tags permissions
    public const SL_VIEW_ALL_TAGS           = 'view all tags';
    public const SL_VIEW_CREATE_TAG         = 'create tag';
    public const SL_VIEW_EDIT_TAG           = 'edit tag';
    public const SL_VIEW_DELETE_TAG         = 'delete tag';
    // Families permissions
    public const SL_VIEW_ALL_FAMILIES       = 'view all families';
    public const SL_VIEW_CREATE_FAMILY      = 'create family';
    public const SL_VIEW_EDIT_FAMILY        = 'edit family';
    public const SL_VIEW_DELETE_FAMILY      = 'delete family';
    // Subfamilies permissions
    public const SL_VIEW_ALL_SUBFAMILIES    = 'view all subfamilies';
    public const SL_VIEW_CREATE_SUBFAMILY   = 'create subfamily';
    public const SL_VIEW_EDIT_SUBFAMILY     = 'edit subfamily';
    public const SL_VIEW_DELETE_SUBFAMILY   = 'delete subfamily';
    // Massive SlOffer Permission
    public const SL_VIEW_ALL_MASSIVE_OFFER     = 'view all massive offer';
    public const SL_VIEW_CREATE_MASSIVE_OFFER  = 'create massive offer';
    // Promos permission
    public const SL_VIEW_ALL_PROMOS         = 'view all promos';
    public const SL_VIEW_CREATE_PROMO       = 'crate promo';
    // Sale Price
    public const SL_EDIT_SALE_PRICE         = 'edit sl_price';
    // Comissions
    public const SL_VIEW_ALL_COMMISSIONS     = 'view all commissions';
    public const SL_VIEW_CREATE_COMMISSION   = 'view all create commission';
    // Salesman (user with Seller Role)
    public const SL_VIEW_ALL_SELLER         = 'view all seller';
    public const SL_VIEW_CREATE_SELLER      = 'create seller';

    /**
     * WAREHOUSE
     */
    // products
        /** Is sale permission */
    // orderer
    public const WH_VIEW_ALL_ORDERERS      = 'view all orderers';
    public const WH_CREATE_ORDERER         = 'create orderer';
    public const WH_EDIT_ORDERER           = 'edit orderer';
    public const WH_DELETE_ORDERER         = 'delete orderer';
    // movement inventory (movements products)
    public const WH_VIEW_ALL_MOVEMENT_INVENTORY            = 'view all movement inventory';
    // transfer between warehouse
    public const WH_VIEW_ALL_TRANSFERS_BETWEEN_WAREHOUSES  = 'view all transfers between warehouses';
    public const WH_CREATE_TRANSFER_BETWEEN_WAREHOUSE      = 'create transfer between warehouses';
    public const WH_EDIT_TRANSFER_BETWEEN_WAREHOUSE        = 'edit transfer between warehouses';
    public const WH_DELETE_TRANSFER_BETWEEN_WAREHOUSE      = 'delete transfer between warehouses';
    // OC
    public const WH_VIEW_ALL_OC            = 'view all OC';
    public const WH_RECEIPT_OC             = 'receipt OC';
    // inventory
    public const WH_VIEW_ALL_INVENTORIES   = 'view all inventories';
    public const WH_CREATE_INVENTORY       = 'create inventory';
    public const WH_EDIT_INVENTORY         = 'edit inventory';
    public const WH_DELETE_INVENTORY       = 'delete inventory';
    // stock adjust
    public const WH_VIEW_ALL_STOCK_ADJUST  = 'view all stock adjusts';
    public const WH_CREATE_STOCK_ADJUST    = 'create stock adjust';
    public const WH_EDIT_STOCK_ADJUST      = 'edit stock adjust';
    public const WH_DELETE_STOCK_ADJUST    = 'delete stock adjust';
    // warehouse
    public const WH_VIEW_ALL_WAREHOUSES    = 'view all warehouses';
    public const WH_CREATE_WAREHOUSE       = 'create warehouse';
    public const WH_EDIT_WAREHOUSE         = 'edit warehouse';
    public const WH_DELETE_WAREHOUSE       = 'delete warehouse';


    /*
     * TI
     */
    public const TI_CREAR_USUARIOS              = 'crear usuarios';
    public const TI_ACTUALIZAR_USUARIOS         = 'actualizar usuarios';
    public const TI_ELIMINAR_USUARIOS           = 'eliminar usuarios';

}
