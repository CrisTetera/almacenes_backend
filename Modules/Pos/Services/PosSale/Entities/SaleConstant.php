<?php

namespace Modules\Pos\Services\PosSale\Entities;

class SaleConstant
{
    public const IVA = 0.19;

    public const TICKET     = 1;
    public const INVOICE    = 2;

    // Status Venta
    public const SALE_STATE_VALE_VENTA  = 17;
    public const SALE_STATE_ANULADA     = 18;
    public const SALE_STATE_REALIZADA   = 19; // Se pagó

    public const PAYMENT_TYPE_EFECTIVO              = 1; // Efectivo
    public const PAYMENT_TYPE_DEBITO                = 2; // Débito
    public const PAYMENT_TYPE_CREDITO               = 3; // Crédito
    public const PAYMENT_TYPE_BANK_CHECK            = 4; // Cheque
    public const PAYMENT_TYPE_CUSTOMER_CREDIT       = 5; // Crédito Cliente (Cuando paga factura a 30,60 o 90 días)
    public const PAYMENT_TYPE_ELECTRONIC_TRANSFER   = 6; // Transferencia electrónica
    // Solo válido para venta empleado:
    public const PAYMENT_TYPE_INTERNAL_CREDIT       = 5; // Internal Credit

    // Tipos de Cheque
    // en español, por que no sé traducirlo xd
    public const CHEQUE_FECHA   = 1;
    public const CHEQUE_DIA     = 2;

    // Prefix
    public const PREFIX_SALE_EMPLOYEE   = 'SE';
    public const PREFIX_SALE_NORMAL     = 'SC';
    public const PREFIX_SALE_INTERNAL   = 'SI';

    // Invoice Credit
    public const POS_CUSTOMER_CREDIT_30_DAYS = 1;
    public const POS_CUSTOMER_CREDIT_60_DAYS = 2;
    public const POS_CUSTOMER_CREDIT_90_DAYS = 3;

    // Pos Origin Sale Ids
    public const ORIGIN_SALE_NORMAL_ID      = 1;
    public const ORIGIN_SALE_GROUND_ID      = 2;
    public const ORIGIN_SALE_CALL_CENTER_ID = 3;

    // Seller Type
    public const NORMAL_SELLER      = 'normal seller';
    public const GROUND_SELLER      = 'ground seller';
    public const CALL_CENTER_SELLER = 'call center seller';
}
