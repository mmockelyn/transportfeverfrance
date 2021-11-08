<?php

namespace App\Http\Controllers\Api\Back\Settings;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function store(Request $request)
    {
        try {
            $page = Page::create([
                "title" => $request->get('title'),
                "slug" => Str::slug($request->get('title')),
                "body" => $request->get('body')
            ]);

            return response()->json($page, 200);
        }catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
