<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class AdminDeleteTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete All Admin Checked Tasks';

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
     * @return int
     */
    public function handle()
    {
        $tasks = Task::all();
        $i = 0;
        foreach ($tasks as $task) {
            if($task->check == 1 and $task->updated_at >= now()->addDays(5)) {
                $task->delete();
                $i++;
            }
        }

        return "Commande Delete Task Counter: ".$i;
    }
}
