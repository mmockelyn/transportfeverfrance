<?php

namespace App\Console;

use App\Events\AgeUser;
use App\Models\User;
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
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            $users = User::all();
            foreach ($users as $user) {
                if($user->created_at >= now()->addYear()) {
                    event(new AgeUser($user, 1));
                }

                if($user->created_at >= now()->addYears(2)) {
                    event(new AgeUser($user, 2));
                }

                if($user->created_at >= now()->addYears(3)) {
                    event(new AgeUser($user, 3));
                }
            }
        })->daily();
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
