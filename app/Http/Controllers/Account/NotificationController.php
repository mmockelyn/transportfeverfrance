<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{


    public function __construct()
    {
    }

    public function index()
    {
        $user = User::find(auth()->user()->id);
        $notifications = $user->notifications;

        return view('account.notify', compact('notifications'));
    }

    public function markAllRead()
    {
        try {
            $user = User::find(auth()->user()->id);
            $user->unreadNotifications->markAsRead();
            return response()->json();
        }catch (\Exception $exception) {
            return response()->json();
        }
    }

    public function allTrash()
    {
        try {
            $user = User::find(auth()->user()->id);
            $user->notifications()->delete();
            return response()->json();
        }catch (\Exception $exception) {
            return response()->json();
        }
    }

    public function readNotif($notif_id)
    {
        $user = User::find(auth()->user()->id);
        $user->notifications()->find($notif_id)->update(["read_at" => now()]);

        return response()->json();
    }

    public function trashNotif($notif_id)
    {
        $user = User::find(auth()->user()->id);
        $user->notifications()->find($notif_id)->delete();

        return response()->json();
    }
}
