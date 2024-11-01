<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define os comandos do Artisan para o aplicativo.
     *
     * @var array
     */
    protected $commands = [
        // \App\Console\Commands\SeuComando::class,
    ];

    /**
     * Define o agendamento de tarefas.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('trending:update')->daily();
    }

    /**
     * Registra os comandos do console para a aplicação.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
