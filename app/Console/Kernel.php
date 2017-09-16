<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Libraries\VBLapi;

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
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function() {
            VBLapi::renewCache();
        })->weekdays()->twiceDaily(9,21);

        $schedule->call(function() {
            VBLapi::renewCache();
        })->weekdays()->twiceDaily(22,23);

        $schedule->call(function() {
            VBLapi::renewCache();
        })->saturdays()->everyThirtyMinutes()->between('7:00', '23:59');

        $schedule->call(function() {
            VBLapi::renewCache();
        })->sundays()->everyThirtyMinutes()->between('7:00', '23:59');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
