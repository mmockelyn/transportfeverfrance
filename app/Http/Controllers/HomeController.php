<?php

namespace App\Http\Controllers;

use App\Events\searchTffrance;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function tffrance()
    {
        $user = User::find(auth()->user()->id);
        event(new searchTffrance($user));
        return redirect()->back();
    }

    public function coming()
    {
        return view('new_front.coming');
    }
}
