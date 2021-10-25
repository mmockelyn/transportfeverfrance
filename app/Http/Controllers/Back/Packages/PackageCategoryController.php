<?php

namespace App\Http\Controllers\Back\Packages;

use App\Http\Controllers\Controller;
use App\Models\Download\DownloadCategory;
use App\Models\Download\DownloadSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageCategoryController extends Controller
{
    public function index()
    {
        return view('back.packages.categories', [
            "categories" => DownloadCategory::all(),
            "subs" => DownloadSubCategory::all()
        ]);
    }

    public function store(Request $request)
    {
        try {
            DownloadCategory::create([
                "title" => $request->get('title'),
                "slug" => Str::slug($request->get('title'))
            ]);

            toastr()->success("Catégorie créer avec succès");
            return redirect()->back();
        }catch (\Exception $exception) {
            toastr()->error("Erreur lors de la création de la catégorie");
            return redirect()->back();
        }
    }

    public function createSubCategory(Request $request)
    {
        try {
            DownloadSubCategory::create([
                "title" => $request->get('title'),
                "slug" => Str::slug($request->get('title')),
                "download_category_id" => $request->get('download_category_id')
            ]);

            toastr()->success("Sous catégorie créer avec succès");
            return redirect()->back();
        }catch (\Exception $exception) {
            toastr()->error("Erreur lors de la création de la sous catégorie");
            return redirect()->back();
        }
    }
}
