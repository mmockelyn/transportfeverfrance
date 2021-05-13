<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Repository\Download\DownloadRepository;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * @var DownloadRepository
     */
    private DownloadRepository $downloadRepository;

    /**
     * PackageController constructor.
     * @param DownloadRepository $downloadRepository
     */
    public function __construct(DownloadRepository $downloadRepository)
    {
        $this->downloadRepository = $downloadRepository;
    }


    public function index()
    {
        return view('account.package.index');
    }
}
