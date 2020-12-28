<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrateAndSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[Needs Laravel Modules, Run migrate:fresh and module:seed]';

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
        $this->info('Executing migrate:fresh');
        Artisan::call('migrate:fresh');
        print Artisan::output();

        $this->info("\nExecuting module:seed");
        Artisan::call('module:seed');
        print Artisan::output();

        $this->info("\nDONE.");
    }
}
