<?php

namespace Modules\Pos\Services\PosDailyCashPos;

use Modules\Pos\Entities\PosDailyCashPos;
use Modules\Pos\Entities\PosSalePos;
use Modules\Pos\Entities\PosCashDeskMovementPos;

class ResumePosDailyCashService
{
    // Constant
    private const G_STATE_OPEN_DAILY_CASH = 12; //
    private const G_STATE_SALE_DONE = 11;

    private const POS_SALE_PAYMENT_TYPE_CASH = 1;
    private const POS_SALE_PAYMENT_TYPE_DEBIT_CARD = 2;
    private const POS_SALE_PAYMENT_TYPE_CREDIT_CARD = 3;
    private const POS_SALE_PAYMENT_TYPE_CUSTOMER_CREDIT = 4;


    // Variables
    private $oPosDailyCash;
    private $timestampNow;
    private $arrOpenPosSales;  // valid PosSale considered in Resume PosDailyCash
    private $arrOpenIngressPosCashMovement; // valid Ingress PosCashMovement considered in Resume PosDailyCash
    private $arrOpenEgressPosCashMovement; // valid Egress PosCashMovement considered in Resume PosDailyCash

    // FIXME: add comments
    public function __construct($posCashDeskId, $timestampNow, $bCompleteResume = true)
    {
        $response = $this->checkInputParametersClass($posCashDeskId, $timestampNow, $bCompleteResume);
        if($response["status"] == "error")  throw new \Exception($response['error']);
        
        $this->oPosDailyCash            = $this->getPosDailyCash_FromCashDeskId($posCashDeskId);
        $this->timestampNow             = $timestampNow;

        if($bCompleteResume)
        {
            $this->arrOpenPosSales          = $this->getArrayOpenPosSales();
            $this->arrOpenIngressPosCashMovement  = $this->getArrayOpenIngressPosCashMovement();
            $this->arrOpenEgressPosCashMovement   = $this->getArrayOpenEgressPosCashMovement();
        } // end function
    } // end funciton

    private function checkInputParametersClass($posCashDeskId, $timestampNow, $bCompleteResume)
    {
        if(! isInt($posCashDeskId))
            return [
                "status" => "error",
                "error" => "El código de caja no es válido",
            ];

        if(! verifyDate($timestampNow))
            return [
                "status" => "error",
                "error" => "La fecha ingresada no es válida",
            ];

        if(! is_bool($bCompleteResume))
            return [
                "status" => "error",
                "error" => "El parámetro flag de resumen completo no es válido (booelano)",
            ];
        
        return [
            "status" => "success"
        ];
    }

    // FIXME: add comments
    private function getPosDailyCash_FromCashDeskId($posCashDeskId)
    {
        $this->oPosDailyCash = PosDailyCashPos::where('pos_cash_desk_id', $posCashDeskId)
                                           ->where('flag_open_daily_cash', true)
                                           ->where('closure_timestamp', null)
                                           ->where('g_state_id', self::G_STATE_OPEN_DAILY_CASH)
                                           ->where('flag_delete', false)
                                           ->first();
        
        if($this->oPosDailyCash == null)
            throw new \Exception("No existe una apertura de caja activa.");

        return $this->oPosDailyCash;
    } // end function

    // FIXME: add comments
    private function getArrayOpenPosSales()
    {
        $arrOpenPosSales = PosSalePos::where('pos_cash_desk_id', $this->oPosDailyCash->pos_cash_desk_id)
                                 ->where('created_at', '>=', $this->oPosDailyCash->opening_timestamp)
                                 ->where('created_at', '<=', $this->timestampNow)
                                 ->where('g_state_id', self::G_STATE_SALE_DONE)
                                 ->where('flag_delete', false)
                                 ->with('posPaymentMethodPos')
                                 ->get();
        return $arrOpenPosSales;
    } // end function


    // FIXME: add comments
    private function getArrayOpenIngressPosCashMovement()
    {
        $arrOpenPosCashMovement = PosCashDeskMovementPos::where('pos_cash_desk_id', $this->oPosDailyCash->pos_cash_desk_id)
                                                 ->where('created_at', '>=', $this->oPosDailyCash->opening_timestamp)
                                                 ->where('created_at', '<=', $this->timestampNow)
                                                 ->whereNotNull('pos_movement_ingress_type_id')
                                                 ->whereNull('pos_movement_egress_type_id')
                                                 ->where('flag_delete', false)
                                                 ->get();
        return $arrOpenPosCashMovement;
    } // end function

    // FIXME: add comments
    private function getArrayOpenEgressPosCashMovement()
    {
        $arrOpenPosCashMovement = PosCashDeskMovementPos::where('pos_cash_desk_id', $this->oPosDailyCash->pos_cash_desk_id)
                                                 ->where('created_at', '>=', $this->oPosDailyCash->opening_timestamp)
                                                 ->where('created_at', '<=', $this->timestampNow)
                                                 ->whereNotNull('pos_movement_egress_type_id')
                                                 ->whereNull('pos_movement_ingress_type_id')
                                                 ->where('flag_delete', false)
                                                 ->get();
        return $arrOpenPosCashMovement;
    } // end function

    /**
     * FIXME: add comments
     */
    public function getCompleteResumePosDailyCash()
    {
        return [
            'opening_timestamp'     => date('d/m/Y H:i:s', strtotime($this->oPosDailyCash->opening_timestamp)),
            'opening_user'          => $this->oPosDailyCash->gUserOpeningCashierPos->getFullName(),
            'ingress_total'         => $this->calculateIngressTotal(),
            'egress_total'          => $this->calculateEgressTotal(),
            'estimated_cash_total'  => $this->calculateEstimatedCashTotal(),
            'ingress_total_detail'  => [
                'initial_amount_cash'           => $this->calculateInitialAmountCash(),
                'ingress_cash_movement_total'   => $this->calculateIngressCashMovementTotal(),
                'sales_total'          => $this->calculateCustomerSalesTotal(),
                'sales_total_detail'   => [
                    'sale_cash_total'             => $this->calculateCustomerSales_ByTypePaymentTotal(self::POS_SALE_PAYMENT_TYPE_CASH),
                    'sale_debit_total'       => $this->calculateCustomerSales_ByTypePaymentTotal(self::POS_SALE_PAYMENT_TYPE_DEBIT_CARD),
                    'sale_credit_total'      => $this->calculateCustomerSales_ByTypePaymentTotal(self::POS_SALE_PAYMENT_TYPE_CREDIT_CARD),
                ],
            ],
            'egress_total_detail' => [
                'egress_cash_movement_total' => $this->calculateEgressCashMovementTotal()
            ],
        ];
    } // end function
    
    /**
     * FIXME: add comments
     */
    public function getInitialResumePosDailyCash()
    {
        return [
            'opening_timestamp'     => date('d/m/Y H:i:s', strtotime($this->oPosDailyCash->opening_timestamp)),
            'opening_user'          => $this->oPosDailyCash->gUserOpeningCashierPos->getFullName(),
            'initial_amount_cash'   => $this->calculateInitialAmountCash(),
        ];
    } // end function

    /**
     * FIXME: add comments
     */
    public function calculateIngressTotal()
    {
        return (
            $this->calculateInitialAmountCash() +
            $this->calculateIngressCashMovementTotal() +
            $this->calculateCustomerSalesTotal() 
        );
    }

    /**
     * FIXME: add comments
     */
    public function calculateInitialAmountCash()
    {
        return intval($this->oPosDailyCash->initial_amount_cash);
    }

    /**
     * FIXME: add comments
     */
    public function calculateCustomerSalesTotal()
    {
        return (
            $this->calculateCustomerSales_ByTypePaymentTotal(self::POS_SALE_PAYMENT_TYPE_CASH) +
            $this->calculateCustomerSales_ByTypePaymentTotal(self::POS_SALE_PAYMENT_TYPE_DEBIT_CARD) +
            $this->calculateCustomerSales_ByTypePaymentTotal(self::POS_SALE_PAYMENT_TYPE_CREDIT_CARD) 
        );
    }

    /**
     * FIXME: add comments
     */
    public function calculateCustomerSales_ByTypePaymentTotal($typePaymentId)
    {
        $total = 0;

        foreach($this->arrOpenPosSales as $openPosSale) {
            $arrTypePayment = $openPosSale->posTypePaymentMethodPos()
                                          ->where('id', $typePaymentId)
                                          ->get();

            if(count($arrTypePayment) == 0) continue; // ignore if not specific type payment don't exist in pos sale

            foreach($arrTypePayment as $typePayment){
                $total += $typePayment->pivot->amount_payment;
            } // end nested foreach
        }//end foreach

        return $total;
    }

    /**
     * FIXME: add comments
     */
    public function calculateIngressCashMovementTotal()
    {
        return intval(
            $this->arrOpenIngressPosCashMovement->sum('amount')
        );
    }

    /**
     * FIXME: add comments
     */
    public function calculateEgressTotal()
    {
        return (
            $this->calculateEgressCashMovementTotal()
        );
    }

    /**
     * FIXME: add comments
     */
    public function calculateEgressCashMovementTotal()
    {
        return intval(
            $this->arrOpenEgressPosCashMovement->sum('amount')
        );
    }

    /**
     * FIXME: add comments
     */
    public function calculateEstimatedCashTotal()
    {
        //monto inicial + venta cliente efectivo + total ingresos + total egresos 
        return (
            $this->calculateInitialAmountCash() + 
            $this->calculateIngressCashMovementTotal() + 
            $this->calculateCustomerSales_ByTypePaymentTotal(self::POS_SALE_PAYMENT_TYPE_CASH) -
            $this->calculateEgressCashMovementTotal()
        );
    }
} // end class