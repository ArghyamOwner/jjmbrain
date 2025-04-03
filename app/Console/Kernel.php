<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;

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
        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run --only-db')->timezone('Asia/Kolkata')->dailyAt('1:05')
            ->before(function () {
                Artisan::call('down');
            })
            ->after(function () {
                Artisan::call('up');
            })->evenInMaintenanceMode();

        $schedule->command('app:delete-old-temporary-files')
            ->dailyAt('23:50')
            ->withoutOverlapping();

        // $schedule->command('inspire')->hourly();
        $schedule->command('app:contractor-task-reminder')
            ->dailyAt('9:00')
            ->withoutOverlapping();
        // ->emailOutputOnFailure('vaibhav.sumatoglobal@gmail.com');

        $schedule->command('app:fetch-tpi-progress-from-smt')
            ->weeklyOn([1, 3, 5], '22:30')
            ->withoutOverlapping();
        // ->emailOutputOnFailure('vaibhav.sumatoglobal@gmail.com');

        $schedule->command('app:fetch-scheme-release-amount-from-smt')
            ->weeklyOn([4, 7], '22:30')
            ->withoutOverlapping();
        // ->emailOutputOnFailure('vaibhav.sumatoglobal@gmail.com');

        $schedule->command('app:contractor-incomplete-task-reminder')
            ->dailyAt('9:10')
            ->withoutOverlapping();
        // ->emailOutputOnFailure('vaibhav.sumatoglobal@gmail.com');

        $schedule->command('app:update-division-stats')
            ->dailyAt('0:05')
            ->withoutOverlapping();

        $schedule->command('app:district-wise-schools')
            ->dailyAt('0:08')
            ->withoutOverlapping();

        $schedule->command('app:delete-old-division-stat')
            ->weeklyOn(1, '0:01')
            ->withoutOverlapping();
        // ->emailOutputOnFailure('vaibhav.sumatoglobal@gmail.com');

        $schedule->command('app:update-district-stats')
            ->dailyAt('0:10')
            ->withoutOverlapping();
        // ->emailOutputOnFailure('vaibhav.sumatoglobal@gmail.com');

        $schedule->command('app:delete-old-district-stats')
            ->weeklyOn(1, '0:02')
            ->withoutOverlapping();

        // REPORTS CRON
        // **** Start **** //

        $schedule->command('app:division-wise-schemes')
            ->dailyAt('0:15')
            ->withoutOverlapping();

        $schedule->command('app:division-summary')
            ->dailyAt('0:30')
            ->withoutOverlapping();

        $schedule->command('app:district-wise-isa')
            ->dailyAt('0:33')
            ->withoutOverlapping();

        $schedule->command('app:district-wise-jalshala-jaldoot-summary')
            ->dailyAt('0:40')
            ->withoutOverlapping();

        $schedule->command('app:division-wise-village-ftk')
            ->dailyAt('0:42')
            ->withoutOverlapping();

        $schedule->command('app:pg-summary')
            ->dailyAt('0:55')
            ->withoutOverlapping();

        $schedule->command('app:role-based-users')
            ->dailyAt('0:58')
            ->withoutOverlapping();

        $schedule->command('app:division-wise-s-o-task-summary')
            ->dailyAt('1:15')
            ->withoutOverlapping();

        $schedule->command('app:so-task-report')
            ->dailyAt('1:18')
            ->withoutOverlapping();

        $schedule->command('app:contractor-completed-task')
            ->dailyAt('1:22')
            ->withoutOverlapping();

        $schedule->command('app:district-summary')
            ->dailyAt('1:25')
            ->withoutOverlapping();

        $schedule->command('app:district-wise-schemes-without-wuc')
            ->dailyAt('1:28')
            ->withoutOverlapping();

        $schedule->command('app:district-wise-wuc')
            ->dailyAt('1:40')
            ->withoutOverlapping();

        $schedule->command('app:division-wise-handover-summary')
            ->dailyAt('1:50')
            ->withoutOverlapping();

        $schedule->command('app:division-wise-litholog')
            ->dailyAt('2:05')
            ->withoutOverlapping();

        $schedule->command('app:division-wise-pipe-network')
            ->dailyAt('2:30')
            ->withoutOverlapping();

        $schedule->command('app:pledged-favour-pg-details')
            ->dailyAt('2:50')
            ->withoutOverlapping();

        $schedule->command('app:schemes-without-isa')
            ->dailyAt('3:05')
            ->withoutOverlapping();

        $schedule->command('app:schemes-without-or-wrong-imis')
            ->dailyAt('3:08')
            ->withoutOverlapping();

        $schedule->command('app:schemes-without-so')
            ->dailyAt('3:12')
            ->withoutOverlapping();

        $schedule->command('app:villages-without-isa')
            ->dailyAt('3:20')
            ->withoutOverlapping();

        $schedule->command('app:villages-without-isa')
            ->dailyAt('3:30')
            ->withoutOverlapping();

        $schedule->command('app:workorder-without-pg')
            ->dailyAt('3:35')
            ->withoutOverlapping();

        $schedule->command('app:delete-old-reports')
            ->dailyAt('4:00')
            ->withoutOverlapping();

        $schedule->command('app:scheme-with-latest-flowmeter-reading')
            ->dailyAt('4:05')
            ->withoutOverlapping();

        $schedule->command('app:division-wise-daily-flowmeter-stats')
            ->dailyAt('4:10')
            ->withoutOverlapping();

        $schedule->command('app:jalshala-staticstics')
            ->dailyAt('00:05')
            ->withoutOverlapping();

        $schedule->command('app:report-reading')
            ->dailyAt('4:10')
            ->withoutOverlapping();
        $schedule->command('app:report-reading-weekly')
            ->monthlyOn(1, '4:25')
            ->withoutOverlapping();

        $schedule->command('app:water-disruption-report')
            ->dailyAt('4:40')
            ->withoutOverlapping();

        // **** End **** //
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
