<?php

namespace App\Http\Controllers\Api\Back;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function list()
    {
        $tasks = Task::all();

        return response()->json([
            "count_tasks_pending" => $tasks->where('check', 0)->count(),
            "count_tasks_complete" => $tasks->where('check', 1)->count(),
            "tasks_complete" => $tasks->where('check', 1),
            "tasks_pending" => $tasks->where('check', 0),
        ]);
    }
}
