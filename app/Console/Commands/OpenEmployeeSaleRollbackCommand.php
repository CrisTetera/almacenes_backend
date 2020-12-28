<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Pos\Services\PosEmployeeSale\OpenEmployeeSalesRollbackService;
use App\Services\Logs\LogFileWriter;
use App\Services\Console\ConsoleWriter;

class OpenEmployeeSaleRollbackCommand extends Command
{
    // Contsant
    private const LOG_FILE = 'open_employee_sale_rollback_command';
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'open_employee_sales:rollback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback open employee sales (PosEmployeeSale mot updated by Cajero user)';


    /**
     * Service with logic Open Employee Sale Rollback
     * 
     * @var Modules\Pos\Services\PosSale\OpenSalesRollbackService
     */
    private $openEmployeeSalesRollbackService;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->openEmployeeSalesRollbackService = new OpenEmployeeSalesRollbackService();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $response = $this->openEmployeeSalesRollbackService->openEmployeeSalesRollback();
        LogFileWriter::writeLogFile($response, self::LOG_FILE);
        ConsoleWriter::writeConsole($response, $this);

        return $response;
    }
}
