<?php

namespace App\Http\Controllers\Back\Wiki;

use App\Http\Controllers\Controller;
use App\Models\Wiki\WikiCategory;
use Illuminate\Http\Request;

class WikiCategoryController extends Controller
{
    public function index()
    {
        $categories = WikiCategory::all();
        return view("back.wiki.category.index", [
            "categories" => $categories
        ]);
    }
}
