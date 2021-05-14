<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Download\DownloadCategory;
use App\Packages\SteamApi\Steam;
use App\Repository\Download\DownloadRepository;
use Illuminate\Http\Request;
use Syntax\SteamApi\Facades\SteamApi;

class PackageController extends Controller
{
    /**
     * @var DownloadRepository
     */
    private DownloadRepository $downloadRepository;
    /**
     * @var Steam
     */
    private Steam $steam;

    /**
     * PackageController constructor.
     * @param DownloadRepository $downloadRepository
     * @param Steam $steam
     */
    public function __construct(DownloadRepository $downloadRepository, Steam $steam)
    {
        $this->downloadRepository = $downloadRepository;
        $this->steam = $steam;
    }


    public function index()
    {
        //dd(auth()->user()->downloads);
        return view('account.package.index');
    }


    public function create()
    {
        return view('account.package.create');
    }

    public function createTffrance()
    {
        $categories = DownloadCategory::all();
        return view('account.package.createTffrance', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $download = $this->downloadRepository->createDownload(
                $request->title,
                $request->meta_keyword,
                $request->provider,
                $request->short_content,
                $request->description,
                $request->download_category_id,
                $request->download_sub_category_id,
                $request->licence
            );
        }catch (\Exception $exception) {

        }
    }
}
