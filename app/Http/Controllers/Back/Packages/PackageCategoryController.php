<?php

namespace App\Http\Controllers\Back\Packages;

use App\Http\Controllers\Controller;
use App\Models\Download\DownloadCategory;
use App\Models\Download\DownloadSubCategory;
use Illuminate\Http\Request;

class PackageCategoryController extends Controller
{
    public function index()
    {
        return view('back.packages.categories', [
            "categories" => DownloadCategory::all(),
            "subs" => DownloadSubCategory::all()
        ]);
    }
}
