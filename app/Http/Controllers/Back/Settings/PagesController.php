<?php

namespace App\Http\Controllers\Back\Settings;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view("back.settings.pages.index", [
            "pages" => Page::all()
        ]);
    }

    public function create()
    {
        return view("back.settings.pages.create");
    }

    public function edit($page_id)
    {
        return view("back.settings.pages.edit", [
            "page" => Page::find($page_id)
        ]);
    }
}
