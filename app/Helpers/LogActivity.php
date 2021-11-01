<?php


namespace App\Helpers;

use App\Models\UserActivityLog;
use Illuminate\Support\Facades\Request;

class LogActivity
{
    public static function addToLog($subject)
    {
        $log = [];
        $log['subject'] = $subject;
        $log['url'] = Request::fullUrl();
        $log['method'] = Request::method();
        $log['ip'] = Request::ip();
        $log['agent'] = Request::header('user-agent');
        $log['user_id'] = auth()->check() ? auth()->user()->id : 1;

        UserActivityLog::create($log);
    }

    public static function logActivitiesLists()
    {
        return UserActivityLog::latest()->get();
    }
}
