<?php

namespace App\Http\Controllers\Api\Back;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function list()
    {
        $arr = [];
        $events = Calendar::all();

        foreach ($events as $event) {
            $arr[] = [
                "id" => $event->id,
                "title" => $event->name,
                "start" => $event->start_date->format('Y-m-d').'T'.$event->start_time->format('H:i:s'),
                "description" => $event->description,
                "end" => $event->end_date->format('Y-m-d').'T'.$event->end_time->format('H:i:s'),
            ];
        }

        return response()->json($arr);
    }
}
