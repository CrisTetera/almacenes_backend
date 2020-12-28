<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Pos\Services\PosSale\OpenSalesRollbackService;
use App\Services\Logs\LogFileWriter;
use App\Services\Console\ConsoleWriter;

class OpenSalesRollbackCommand extends Command
{
    // Contsant
    private const LOG_FILE = 'open_sale_rollback_command';
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'open_sales:rollback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback open sales (PosSale mot updated by Cajero user)';

    /**
     * Service with logic Open Sale Rollback
     * 
     * @var Modules\Pos\Services\PosSale\OpenSalesRollbackService
     */
    private $openSalesRollbackService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->openSalesRollbackService = new OpenSalesRollbackService();

    }

    /**
     * Execute the console command.
     *
     * @return array
     */
    public function handle()
    {
        $response = $this->openSalesRollbackService->openSalesRollback();
        LogFileWriter::writeLogFile($response, self::LOG_FILE);
        ConsoleWriter::writeConsole($response, $this);

        return $response;
    }
}
