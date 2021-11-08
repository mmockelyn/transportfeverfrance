<?php

namespace App\Http\Controllers\Back\Settings;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {
        return view('back.settings.social.index', [
            "follows" => Follow::all()
        ]);
    }
}
