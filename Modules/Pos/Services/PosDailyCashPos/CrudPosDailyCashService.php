<?php

namespace Modules\Pos\Services\PosDailyCashPos;

use Illuminate\Http\Request;
use Modules\Pos\Entities\PosDailyCashPos;
use App\Http\Response\CustomResponse;
use Modules\General\Services\GUserPos\RolePermissionService;
use Modules\General\Services\GUserPos\PermissionConstant;
use DB;

class CrudPosDailyCashService
{
    // Constant
    private const G_STATE_DONE_DAILY_CASH =1;
    private const G_STATE_CONFIRMED_DAILY_CASH = 2;
    private const G_STATE_OPEN_DAILY_CASH = 12;

    private const POS_SALE_PAYMENT_TYPE_CASH = 1;
    private const POS_SALE_PAYMENT_TYPE_DEBIT_CARD = 2;
    private const POS_SALE_PAYMENT_TYPE_CREDIT_CARD = 3;
    private const POS_SALE_PAYMENT_TYPE_CHECK = 4;
    private const POS_SALE_PAYMENT_TYPE_CUSTOMER_CREDIT = 5;

    private const POS_EMPLOYEE_SALE_PAYMENT_TYPE_CASH = 1;
    private const POS_EMPLOYEE_SALE_PAYMENT_TYPE_DEBIT_CARD = 2;
    private const POS_EMPLOYEE_SALE_PAYMENT_TYPE_CREDIT_CARD = 3;
    private const POS_EMPLOYEE_SALE_PAYMENT_TYPE_CHECK = 4;
    private const POS_EMPLOYEE_SALE_PAYMENT_TYPE_EMPLOYEE_CREDIT = 5;
    
    
    // Variables
    private $exceptions;

    // FIXME: add comments
    public function __construct()
    {
        $this->exceptions = new ExceptionsPosDailyCashService();
    } // end function


    // FIXME: add comments
    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {
            if($this->exceptions->checkNotAlreadyOpenCashDesk($request->pos_cash_desk_id))
            {
                $posDailyCash = new PosDailyCashPos();
            
                $posDailyCash->pos_cash_desk_id = $request->pos_cash_desk_id;
                $posDailyCash->g_cashier_opening_user_id = $request->g_cashier_user_id;
                $posDailyCash->initial_amount_cash = $request->initial_amount_cash;
                $posDailyCash->g_state_id = self::G_STATE_OPEN_DAILY_CASH;
                $posDailyCash->opening_timestamp = date('Y-m-d H:i:s');
                $posDailyCash->opening_observation = $request->observation;
                $posDailyCash->flag_open_daily_cash = true;
                
                $posDailyCash->save();

                DB::commit();

                return CustomResponse::created([
                    'pos_daily_cash_pos' => $posDailyCash,
                ]);
            } // end if
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return CustomResponse::error($e);
        }
    }

    /**
     * Get initial resume of open PosDailyCashPos
     */
    public function getInitialResume(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $dtNow = date('Y-m-d H:i:s');
            $bCompleteResume = false;
            $resumePosDailyCashService = new ResumePosDailyCashService($request->pos_cash_desk_id, $dtNow, $bCompleteResume);
            $resumeResponse = $resumePosDailyCashService->getInitialResumePosDailyCash();

            return CustomResponse::ok([
                'data' => array('resume_pos_daily_cash_pos' => $resumeResponse),
            ]);
        }
        catch(\Exception $e)
        {
            return CustomResponse::error($e);
        }
    } // end function

    /**
     * Get complete resume of open PosDailyCashPos
     */
    public function getCompleteResume(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $rolePermissionService = new RolePermissionService();
            $check = $rolePermissionService->checkAuthorization($request->auth_code_supervisor, PermissionConstant::POS_GET_RESUMEN_COMPLETO_ARQUEO_CAJA);

            $dtNow = date('Y-m-d H:i:s');
            $resumePosDailyCashService = new ResumePosDailyCashService($request->pos_cash_desk_id, $dtNow);
            $resumeResponse = $resumePosDailyCashService->getCompleteResumePosDailyCash();

            return CustomResponse::ok([
                'data' => array('resume_pos_daily_cash_pos' => $resumeResponse),
            ]);
        }
        catch(\Exception $e)
        {
            return CustomResponse::error($e);
        }
    } // end function

    /**
     * Get initial resume of close PosDailyCashPos
     */
    public function posDailyCashClose(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $rolePermissionService = new RolePermissionService();
            $gCashSupervisorId = $rolePermissionService->checkAuthorization($request->auth_code_supervisor, PermissionConstant::POS_CERRAR_CAJA);

            $oPosDailyCash = $this->getPosDailyCash_FromCashDeskId($request->pos_cash_desk_id);
            
            $dtNow = date('Y-m-d H:i:s');
            $resumePosDailyCashService = new ResumePosDailyCashService($request->pos_cash_desk_id, $dtNow);
            
            $estimatedCashTotal = $resumePosDailyCashService->calculateEstimatedCashTotal();
            $difference = $estimatedCashTotal - $request->real_cash_total;
            
            if(! isInt($difference))
                throw new \Exception("Diferencia no es un número entero");
            

            $oPosDailyCash->pos_cash_desk_id = $request->pos_cash_desk_id;
            $oPosDailyCash->g_cashier_closure_user_id = $request->g_cashier_closure_user_id;
            $oPosDailyCash->g_state_id = self::G_STATE_DONE_DAILY_CASH;
            $oPosDailyCash->closure_timestamp = date('Y-m-d H:i:s');
            $oPosDailyCash->ingress_total = $resumePosDailyCashService->calculateIngressTotal();
            $oPosDailyCash->sales_total = $resumePosDailyCashService->calculateCustomerSalesTotal();
            $oPosDailyCash->sales_cash_total = $resumePosDailyCashService->calculateCustomerSales_ByTypePaymentTotal(self::POS_SALE_PAYMENT_TYPE_CASH);
            $oPosDailyCash->sales_credit_total = $resumePosDailyCashService->calculateCustomerSales_ByTypePaymentTotal(self::POS_SALE_PAYMENT_TYPE_CREDIT_CARD);
            $oPosDailyCash->sales_debit_total = $resumePosDailyCashService->calculateCustomerSales_ByTypePaymentTotal(self::POS_SALE_PAYMENT_TYPE_DEBIT_CARD);
            $oPosDailyCash->ingress_cash_movement_total = $resumePosDailyCashService->calculateIngressCashMovementTotal();
            $oPosDailyCash->egress_total = $resumePosDailyCashService->calculateEgressTotal();
            $oPosDailyCash->egress_cash_movement_total = $resumePosDailyCashService->calculateEgressCashMovementTotal();
            $oPosDailyCash->estimated_cash_total = $estimatedCashTotal;
            $oPosDailyCash->real_cash_total = $request->real_cash_total;
            $oPosDailyCash->difference = $difference;
            $oPosDailyCash->closure_observation = $request->closure_observation;
            $oPosDailyCash->flag_open_daily_cash = false;
            
            $oPosDailyCash->save();

            DB::commit();

            return CustomResponse::ok([
                "data" => array('pos_daily_cash_pos' => $oPosDailyCash),
            ]);
         
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return CustomResponse::error($e);
        }
    } // end function

    /**
     * Get Open PosDailyCash with cash_deskk id filter 
     */
     public function getPosDailyCash_FromCashDeskId($posCashDeskId)
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

} // end class