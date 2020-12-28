<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $this->rollbackPosSaleTaskSchedule($schedule);
        $this->rollbackEmployeePosSaleTaskSchedule($schedule);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Define Schedule that Run Artisan Command for rollback OpenSale
     * 
     * @param  
     */
    private function rollbackPosSaleTaskSchedule(Schedule $schedule)
    {
        // Rollback PosSale
        $schedule->call(function () {
            // Call artisan command
            \Artisan::call("open_sales:rollback");
        })->everyFifteenMinutes()->between('6:00', '23:59');
    }

    private function rollbackEmployeePosSaleTaskSchedule($schedule)
    {
        // Rollback PosSale
        $schedule->call(function () {
            // Call artisan command
            \Artisan::call("open_employee_sales:rollback");
        })->everyFifteenMinutes()->between('6:00', '23:59');
    }
}
