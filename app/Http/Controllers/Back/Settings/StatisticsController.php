<?php

namespace App\Http\Controllers\Back\Settings;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Analytics\AnalyticsFacade;
use Spatie\Analytics\Period;

class StatisticsController extends Controller
{
    public function index()
    {
        dd(AnalyticsFacade::fetchVisitorsAndPageViews(Period::days(7)));
        //return view('back.settings.stats.index');
    }
}
