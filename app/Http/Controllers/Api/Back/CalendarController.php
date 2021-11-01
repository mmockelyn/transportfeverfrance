<?php

namespace App\Http\Controllers\Api\Back;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Carbon\Carbon;
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
        $start_date = Carbon::createFromTimestamp(strtotime($request->get('start_date')));
        $end_date = Carbon::createFromTimestamp(strtotime($request->get('end_date')));

        try {
            $calendar = Calendar::create([
                "name" => $request->get('name'),
                "description" => $request->get('description'),
                "location" => $request->get('location'),
                "start_date" => $start_date,
                "end_date" => $end_date,
                "allday" => $request->get('allDay') == true ? 1 : 0
            ]);

            LogActivity::addToLog("Ajout de l'évènement <strong>$calendar->name</strong> à votre calendrier effectuer");
            return response()->json($calendar);
        } catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());

            return $exception->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        $start_date = Carbon::createFromTimestamp(strtotime($request->get('start_date')));
        $end_date = Carbon::createFromTimestamp(strtotime($request->get('end_date')));

        try {
            $calendar = Calendar::find($id);
            $calendar->update([
                "name" => $request->get('name'),
                "description" => $request->get('description'),
                "location" => $request->get('location'),
                "start_date" => $start_date,
                "end_date" => $end_date,
                "allday" => $request->get('allDay') == true ? 1 : 0
            ]);

            LogActivity::addToLog("Edition de l'évènement <strong>$calendar->name</strong> à votre calendrier effectuer");
            return response()->json();
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());

            return $exception->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            $calendar = Calendar::find($id);
            $calendar->delete();

            LogActivity::addToLog("Suppression de l'évènement <strong>$calendar->name</strong> à votre calendrier effectuer");
            return response()->json();
        } catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            return $exception->getMessage();
        }
    }
}
