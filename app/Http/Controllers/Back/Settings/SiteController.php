<?php

namespace App\Http\Controllers\Back\Settings;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view("back.settings.site.index", [
            "site" => Site::all()->first()
        ]);
    }

    public function update(Request $request)
    {
        try {
            Site::query()->first()->update([
                "name" => $request->name,
                "facebook_link" => $request->facebook_link,
                "twitter_link" => $request->twitter_link,
                "insta_link" => $request->insta_link,
                "discord_link" => $request->discord_link,
                "steam_link" => $request->steam_link,
            ]);

            return response()->json();
        }catch (\Exception $exception) {
            return response()->json(null, 500);
        }
    }
}
