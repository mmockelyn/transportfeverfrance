<?php

namespace App\Http\Controllers\Front\Wiki;

use App\Http\Controllers\Controller;
use App\Models\Wiki\Wiki;
use App\Models\Wiki\WikiCategory;
use Illuminate\Http\Request;

class WikiController extends Controller
{
    public function index()
    {
        $wiki_categories = WikiCategory::all();
        //dd($categories);
        return view('new_front.wiki.index', compact('wiki_categories'));
    }

    public function category($wiki_category_id)
    {
        $wiki_categories = WikiCategory::all();
        $category = WikiCategory::find($wiki_category_id)->load('wikis');
        //dd($category->wikis);
        return view('new_front.wiki.category', [
            "category" => $category,
            "wikis" => $category->wikis,
            "wiki_categories" => $wiki_categories
        ]);
    }

    public function show($slug)
    {
        $wiki_categories = WikiCategory::all();
        $wiki = Wiki::query()->where('slug', $slug)->first();
        return view('new_front.wiki.show', [
            "wiki" => $wiki,
            "category" => $wiki->category,
            "wiki_categories" => $wiki_categories
        ]);
    }
}
