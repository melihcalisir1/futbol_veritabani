<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * These should be classes that implement the ShouldQueue interface.
     */
    protected function schedule(Schedule $schedule)
    {
        // Her gün gece yarısı puan durumlarını güncelle
        $schedule->command('standings:update')->dailyAt('00:00');
    }

    /**
     * Register the commands for your application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
} 