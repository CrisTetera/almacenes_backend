<?php

namespace Modules\Pos\Services\DTEPos\Helpers;

class Helpers
{
    // constant
    private const CODE_BOLETA_AFECTA = 39;
    private const CODE_BOLETA_EXENTA = 41;

    private const CODE_FACTURA_AFECTA = 33; 
    private const CODE_FACTURA_EXENTA = 34; 

    private const CODE_OC = 801; 

    private const CODE_TIPO_TRANSACCION_VENTAS_GIRO = 1; 
    private const CODE_TIPO_TRANSACCION_VENTAS_ACTIVO_FIJO = 2; 
    private const CODE_TIPO_TRANSACCION_VENTAS_BIEN_RAIZ = 3; 

    private const CODE_IND_SERVICIO_FACTURA_SEVICIOS_PERIODICOS_DOMICILIARIOS = 1; 
    private const CODE_IND_SERVICIO_FACTURA_OTROS_SERVICIOS_PERIODICOS = 2; 
    private const CODE_IND_SERVICIO_FACTURA_SERVICIOS = 3; 
    private const CODE_IND_SERVICIO_HOTELERIA = 4; 
    private const CODE_IND_SERVICIO_TRANSPORTE_TERRESTRE_INTERNACIONAL = 5;

    private const CODE_FORMA_PAGO_CONTADO = 1; 
    private const CODE_FORMA_PAGO_CREDITO = 2; 
    private const CODE_FORMA_PAGO_SIN_COSTO = 3; 


    private const TYPE_DISCOUNT_OR_CHARGE_PERCENTAGE = '%';
    private const TYPE_DISCOUNT_OR_CHARGE_AMOUNT = '$';
    
    private const TYPE_MOVEMENT_DISCOUNT = 'D';
    private const TYPE_MOVEMENT_CHARGE = 'R';

    private const REFERENCE_CODE_CANCEL_DOCUMENT = 1;
    private const REFERENCE_CODE_FIXED_TEXT_DOCUMENT = 2;
    private const REFERENCE_CODE_FIXED_AMOUNT_DOCUMENT = 3;
    
    /**
     * FIXME: add comments
     */
    public static function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    } // end function

    /**
     * FIXME: add comments
     */
    public static function correctBoletaDTECode($dteCode)
    {
        return $dteCode === self::CODE_BOLETA_AFECTA || $dteCode === self::CODE_BOLETA_EXENTA;
    } // end function


    /**
     * FIXME: add comments
     */
    public static function correctFacturaDTECode($dteCode)
    {
        return $dteCode === self::CODE_FACTURA_AFECTA || $dteCode === self::CODE_FACTURA_EXENTA;
    } // end funciton

    /**
     * FIXME: add comments
     */
    public static function correctFacturaOrBoletaDTECode($dteCode)
    {
        return Helpers::correctBoletaDTECode($dteCode) || Helpers::correctFacturaDTECode($dteCode);
    } // end function

    /**
     * FIXME: add comments
     */
    public static function correctOC_DTECode($dteCode)
    {
        return $dteCode === self::CODE_OC;
    } // end function

    /**
     * FIXME: add comments
     */
    public static function correctTipoTransaccionCode($tipoTransaccionCode)
    {
        return $tipoTransaccionCode === self::CODE_TIPO_TRANSACCION_VENTAS_GIRO || 
               $tipoTransaccionCode === self::CODE_TIPO_TRANSACCION_VENTAS_ACTIVO_FIJO || 
               $tipoTransaccionCode === self::CODE_TIPO_TRANSACCION_VENTAS_BIEN_RAIZ;
    } // end funciton

    /**
     * FIXME: add comments
     */
    public static function correctFormaPagoCode($formaPago)
    {
        return $formaPago === self::CODE_FORMA_PAGO_CONTADO || 
               $formaPago === self::CODE_FORMA_PAGO_CREDITO || 
               $formaPago === self::CODE_FORMA_PAGO_SIN_COSTO;
    } // end funciton


    /**
     * FIXME: add comments
     */
    public static function correctIndiceServicioCode($indiceServicio)
    {
        return $indiceServicio === self::CODE_IND_SERVICIO_FACTURA_SEVICIOS_PERIODICOS_DOMICILIARIOS || 
               $indiceServicio === self::CODE_IND_SERVICIO_FACTURA_OTROS_SERVICIOS_PERIODICOS || 
               $indiceServicio === self::CODE_IND_SERVICIO_FACTURA_SERVICIOS ||
               $indiceServicio === self::CODE_IND_SERVICIO_HOTELERIA ||
               $indiceServicio === self::CODE_IND_SERVICIO_TRANSPORTE_TERRESTRE_INTERNACIONAL;
    } // end funciton


    /**
     * Validador de RUT con digito verificador 
     *
     * @param string $rut
     * @return boolean
     */
    public static function rutValidate($rut) 
    {
        $rut=str_replace('.', '', $rut);
        if (preg_match('/^(\d{1,9})-((\d|k|K){1})$/',$rut,$d)) 
        {
            $s=1;$r=$d[1];for($m=0;$r!=0;$r/=10)$s=($s+$r%10*(9-$m++%6))%11;
            return chr($s?$s+47:75)==strtoupper($d[2]);
        }
    }  

    /**
     * Check if input parameter is a string not void
     * 
     * @param integer $code
     * @return bool
     */
    public static function stringNotVoid($string)
    {
        return preg_match('/\S/', $string);
    }

    /**
     * Check if input parameter is a valid code of Actividad Comercial for SII.
     * Must to be Integer and a length of 6 characters
     * 
     * @param integer $code
     * @return bool
     */
    public static function correctActecoCode($code)
    {
        return intval($code) && preg_match('/^\d{1,6}$/', $code);
    }


    /**
     * Check if input parameter is a valid code Sucursal SII.
     * Must to be Integer and a length of 9 characters
     * 
     * @param string $code
     * @return bool
     */
    public static function correctSucursalCodeSII($code)
    {
        return intval($code) && preg_match('/^\d{1,9}$/', $code);
    }

    /**
     * Check if input parameter is a numeric amount greater than 0
     * 
     * @param integer/float $amount
     * @return bool
     */
    public static function amountValidate($amount)
    {
        return is_numeric($amount) && $amount > 0;
    }

    /**
     * Check if input parameter is a numeric amount greater or equals than 0
     * 
     * @param integer/float $amount
     * @return bool
     */
    public static function amountZeroEnableValidate($amount)
    {
        return is_numeric($amount) && $amount >= 0;
    }

    /**
     * Check if input parameter is a numeric percentahe greater than 0 and lower than 100
     * 
     * @param integer/float $percentage
     * @return bool
     */
    public static function percentageValidate($percentage)
    {
        return is_numeric($percentage) && $percentage > 0 && $percentage < 100;
    }
    
    /**
     * Check if input parameter is a numeric percentahe greater than or equals 0 and lower than 100
     * 
     * @param integer/float $percentage
     * @return bool
     */
    public static function percentageZeroEnableValidate($percentage)
    {
        return is_numeric($percentage) && $percentage >= 0 && $percentage < 100;
    }

    /**
     * Check if input parameter is a valid boolean integer (0 or 1)
     * 
     * @param integer $booleanInt
     * @return bool
     */
    public static function booleanIntValidate($booleanInt)
    {
        return $booleanInt === 0 || $booleanInt === 1;
    }
    

    /**
     * Check if type discount is '%' or '$'
     * 
     * @param string $typeDiscount
     * @return bool
     */
    public static function typeDiscountOrChargeValidate($typeDiscount)
    {
        return $typeDiscount === self::TYPE_DISCOUNT_OR_CHARGE_PERCENTAGE || $typeDiscount === self::TYPE_DISCOUNT_OR_CHARGE_AMOUNT;
    }

    /**
     * Check if type discount is '%' or '$'
     * 
     * @param string $typeDiscount
     * @return bool
     */
    public static function typeMovementValidate($typeMovement)
    {
        return $typeMovement === self::TYPE_MOVEMENT_DISCOUNT || $typeMovement === self::TYPE_MOVEMENT_CHARGE;
    }

    /**
     * Check if document reference code is correct
     * 
     * @param string $typeDiscount
     * @return bool
     */
    public static function codeReferenceValidate($codRef)
    {
        return $codRef === self::REFERENCE_CODE_CANCEL_DOCUMENT || 
               $codRef === self::REFERENCE_CODE_FIXED_TEXT_DOCUMENT ||
               $codRef === self::REFERENCE_CODE_FIXED_AMOUNT_DOCUMENT;
    }

} // end class