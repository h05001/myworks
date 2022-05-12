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
        \App\Console\Commands\Scraping::class//コマンドの登録
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
        //everyFiveMinutes();->weeklyOn(4, '18:53');
        // スケジュールの登録（「->daily()」は毎日深夜１２時に実行）
        //everyTenMinutes();->everyTenMinutes()->between('23:00', '23:30')->withoutOverlapping()
        //->weeklyOn(1, '8:00');->weekly()->wednesdays()->at('21:30');
        $schedule->command('command:scraping')->weeklyOn(4, '20:50');

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
}
