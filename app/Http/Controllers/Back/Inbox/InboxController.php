<?php

namespace App\Http\Controllers\Back\Inbox;

use App\Http\Controllers\Controller;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index()
    {
        return view('back.inbox.index');
    }

    public function oauth()
    {
        dd(LaravelGmail::makeToken());
        return LaravelGmail::redirect();
    }

    public function oauthCallback()
    {
        LaravelGmail::makeToken();
        return view('back.inbox.inbox');
    }

    public function oauthLogout()
    {
        LaravelGmail::logout();
        return view('back.inbox.index');
    }
}
