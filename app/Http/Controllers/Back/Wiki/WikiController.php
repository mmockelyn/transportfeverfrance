<?php

namespace App\Http\Controllers\Back\Wiki;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Wiki\CreateWikiRequest;
use App\Models\Wiki\Wiki;
use App\Models\Wiki\WikiCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class WikiController extends Controller
{
    public function dashboard()
    {
        return view('back.wiki.dashboard', [
            "wikis" => Wiki::all()
        ]);
    }

    public function create()
    {
        return view('back.wiki.create', [
            "categories" => WikiCategory::all()
        ]);
    }

    public function store(CreateWikiRequest $request)
    {

        //dd($request->all());
        try {
            $article = Wiki::create([
                "title" => $request->title,
                "slug" => Str::slug($request->title),
                "contents" => $request->contents,
                "published" => 0,
                "wiki_category_id" => $request->wiki_category_id
            ]);

            toastr()->success("L'article <strong>".$article->title."</strong> à été créer avec succès !", "Création d'un article");
            return redirect()->route('back.wiki.dashboard');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        return view('back.wiki.show', [
            "wiki" => Wiki::find($id),
        ]);
    }

    public function edit($id)
    {
        return view('back.wiki.edit', [
            "wiki" => Wiki::find($id),
            "categories" => WikiCategory::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            Wiki::find($id)->update([
                "title" => $request->title,
                "slug" => Str::slug($request->title),
                "contents" => $request->contents,
                "published" => 0,
                "wiki_category_id" => $request->wiki_category_id
            ]);

            $article = Wiki::find($id);

            toastr()->success("L'article <strong>$article->title</strong> à été editer avec succès !", "Edition d'un article");
            return redirect()->route('back.wiki.edit', $id);
        }catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
