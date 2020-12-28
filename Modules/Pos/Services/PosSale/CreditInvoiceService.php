<?php

namespace Modules\Sale\Services\PosSale;

use Modules\Pos\Entities\PosSale;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Dotenv\Exception\ValidationException;
use Modules\Sale\Entities\SlCustomerAccount;
use Illuminate\Support\Facades\DB;
use Modules\Sale\Entities\SlCustomerAccountReceivable;


class CreditInvoiceService
{

    /**
     * Check credit invoice if needed
     * (this is separate from handleIfNedded, because the table sl_sale_invoice is created after
     * dte is generated, so if an error occurs in this function, there will not be a
     * database error and a dte generated)
     *
     * @param PosSale $sale
     * @param array $payments
     *
     * @return void
     */
    public function checkIfNeeded(PosSale $sale, $payments)
    {
        if (!$this->hasCustomerCredit($payments) || !$sale->sl_customer_id || $sale->pos_sale_type_id !== SaleConstant::INVOICE) {
            return false;
        }

        // Here, customer credit option is inside $payments and $payments array length is at least 1
        if ( count($payments) > 1 ) {
            throw new ValidationException("La opción 'Crédito Cliente' no puede combinarse con otros medios de pago");
        }

        $payments[0]['customer_credit_option_id'] = isset($payments[0]['customer_credit_option_id']) ? $payments[0]['customer_credit_option_id'] : -1;
        $customerCreditId = $payments[0]['customer_credit_option_id'];
        $this->checkCustomerCreditOption($customerCreditId);
    }

    /**
     * Handle Credit Invoice if needed
     *
     * $payments structure:
     * [
     *       [
     *           "id_sale_payment_id" => 1,
     *           "amount_payment" => 101,
     *           "rounding_law" => 0
     *       ],
     *       [
     *           "id_sale_payment_id" => 2,
     *           "amount_payment" => 160,
     *           'voucher_number' => 168901
     *       ]
     * ]
     * or
     * $payments structure:
     * [
     *      [
     *          'id_sale_payment_id' => 5,
     *          'amount_payment' => 261,
     *          'customer_credit_option_id' => 1 // 1: 30 días, 2: 60 días, 3: 90 días
     *      ]
     * ]
     * @param PosSale $sale
     * @param array $payments
     * @return boolean
     */
    public function handleIfNeeded(PosSale $sale, $payments)
    {
        if (!$this->hasCustomerCredit($payments) || !$sale->sl_customer_id || $sale->pos_sale_type_id !== SaleConstant::INVOICE) {
            return false;
        }
        try {
            DB::beginTransaction();
            $sale->pos_customer_credit_option_id = $payments[0]['customer_credit_option_id'];
            $sale->save();
            $this->addCustomerAccountDebt($sale, $payments[0]['amount_payment']);
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    /**
     * Return true if payments array has customer credit option.
     *
     * @param array $payments
     * @return boolean
     */
    public function hasCustomerCredit($payments)
    {
        return in_array( SaleConstant::PAYMENT_TYPE_CUSTOMER_CREDIT, array_column($payments, 'id_sale_payment_id') );
    }


    /**
     * Check if customer credit id exists.
     *
     * @param integer $customerCreditId
     * @return boolean
     */
    public function checkCustomerCreditOption($customerCreditId)
    {
        $customerCreditOptionsIds = [
            SaleConstant::POS_CUSTOMER_CREDIT_30_DAYS,
            SaleConstant::POS_CUSTOMER_CREDIT_60_DAYS,
            SaleConstant::POS_CUSTOMER_CREDIT_90_DAYS
        ];
        $exists = in_array($customerCreditId, $customerCreditOptionsIds);
        if (!$exists) {
            throw new ValidationException('Debe enviar un identificador de opción de crédito: 1 (30 dias), 2 (60 días) o 3 (90 días)');
        }
        return true;
    }


    /**
     * Increments Customer Account Debt
     *
     * @param PosSale $sale
     * @param integer $amount
     * @return void
     */
    public function addCustomerAccountDebt(PosSale $sale, $amount)
    {
        $customerAccount = SlCustomerAccount::where('sl_customer_id', $sale->sl_customer_id)
                                            ->where('flag_delete', false)
                                            ->first();

        // To avoid dte errors, instead of throwing exception, we generate a new customer account
        if ( !$customerAccount ) {
            $customerAccount = new SlCustomerAccount([
                'sl_customer_id' => $sale->sl_customer_id,
                'debt_amount' => 0,
                'flag_delete' => false
            ]);
            $customerAccount->save();
        }
        $customerAccount->debt_amount += $amount;
        $customerAccount->save();
        $this->addCustomerAccountReceivable($sale, $customerAccount, $sale->pos_customer_credit_option_id, $amount);
    }

    /**
     * Add customer account receivables (si son 90 días, añade 3 cuotas)
     *
     * @param PosSale $sale
     * @param SlCustomerAccount $slCustomerAccount
     * @param integer $customerCreditOptionId
     * @param integer $amount
     * @return void
     */
    public function addCustomerAccountReceivable(PosSale $sale, SlCustomerAccount $customerAccount, $customerCreditOptionId, $amount)
    {
        $amounts = $this->divideAccountsReceivable($customerCreditOptionId, $amount);
        $days = 30;
        foreach( $amounts as $amount )
        {
            $slCustomerAccountReceivable = new SlCustomerAccountReceivable([
                'sl_customer_account_id' => $customerAccount->id,
                'sl_sale_invoice_id' => $sale->sl_sale_invoice_id,
                'amount' => $amount,
                'pay_date' => date('Y-m-d', strtotime("+$days days")),
                'real_pay_date' => null,
                'flag_delete' => false
            ]);
            $slCustomerAccountReceivable->save();
            $days += 30;
        }

    }

    /**
     * Divide accounts receivable.
     * For example $100.000 at 90 días returns [$33.333, $33.333, $33.334]
     *
     * @param integer $times
     * @param integer $amount
     * @return array
     */
    public function divideAccountsReceivable($times, $amount)
    {
        $amountPerMonth = intdiv( $amount, $times );
        $amounts = array_fill( 0, $times - 1, $amountPerMonth );
        array_push( $amounts, $amount - $amountPerMonth * ($times - 1) );
        return $amounts;
    }

}
