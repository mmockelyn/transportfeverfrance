<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
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
}
