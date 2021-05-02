<?php

namespace App\Http\Controllers\Front\Download;

use App\Helpers\Format;
use App\Http\Controllers\Controller;
use App\Models\Download\DownloadSubCategory;
use App\Repository\Download\DownloadRepository;
use Illuminate\Http\Request;
use Syntax\SteamApi\Facades\SteamApi;


class DownloadController extends Controller
{
    /**
     * @var DownloadRepository
     */
    private $downloadRepository;

    /**
     * DownloadController constructor.
     * @param DownloadRepository $downloadRepository
     */
    public function __construct(DownloadRepository $downloadRepository)
    {
        $this->downloadRepository = $downloadRepository;
    }

    public function category($subCategory_id)
    {
        $downloads = $this->downloadRepository->getActiveOrderByDateForCategory(10, $subCategory_id);
        $sub = DownloadSubCategory::findOrFail($subCategory_id);

        return view('front.download.category', compact('downloads', 'sub'));
    }

    public function show(Request $request, $slug)
    {
        $download = $this->downloadRepository->getPostBySlug($slug);

        //dd(Format::IsModAuthor(1, 1));

        return view('front.download.show', compact('download'));
    }
}
