<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RunTests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:run {--reset : Reset Database, Migrate and Seed} {--filter= : Filter files to run test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Laravel Tests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $reset = $this->option('reset');
        $filter = $this->option('filter');
        if ($reset) {
            $this->info('Migrating and seeding');
            Artisan::call('migrate:fresh');
            print_r( Artisan::output() );
            Artisan::call('module:seed');
            print_r( Artisan::output() );
        }

        $this->info('Executing Tests');
        if ($filter) {
            $this->info("Filtering test files: $filter");
            exec("\"./vendor/bin/phpunit\" --filter $filter", $output, $returnCode);
            $this->printExecOutput($output, $returnCode);
        } else {
            exec("\"./vendor/bin/phpunit\"", $output, $returnCode);
            $this->printExecOutput($output, $returnCode);
        }
    }

    private function printExecOutput($output, $returnCode) {
        if ($returnCode !== 0) {
            print PHP_EOL . implode($output, PHP_EOL) . PHP_EOL;
        }
        
        // Show summary (last line)
        print array_pop($output) . PHP_EOL;
    }
}
