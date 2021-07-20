<?php

namespace App\Http\Controllers\Api\Back;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
                "start" => $event->start_date->format('Y-m-d H:i:s'),
                "description" => $event->description,
                "end" => $event->end_date->format('Y-m-d H:i:s'),
            ];
        }

        return response()->json($arr);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function delete($id)
    {
        try {
            Calendar::find($id)->delete();

            return response()->json();
        }catch (\Exception $exception) {
            Log::error("Impossible de supprimer l'évènement", [
                "sector" => "Calendar",
                "error" => $exception->getMessage()
            ]);
            return $exception->getMessage();
        }
    }
}
