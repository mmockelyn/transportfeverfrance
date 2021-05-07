<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Core\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $user = auth()->user();
        $badges = Badge::all();

        return view('account.badge', compact('user', 'badges'));
    }
}
