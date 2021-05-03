<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Download\DownloadSupport;
use App\Models\Download\DownloadSupportRoom;
use App\Repository\Download\DownloadRepository;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    /**
     * @var DownloadRepository
     */
    private $downloadRepository;
    /**
     * @var DownloadSupport
     */
    private $downloadSupport;
    /**
     * @var DownloadSupportRoom
     */
    private $downloadSupportRoom;

    /**
     * DownloadController constructor.
     * @param DownloadRepository $downloadRepository
     * @param DownloadSupport $downloadSupport
     * @param DownloadSupportRoom $downloadSupportRoom
     */
    public function __construct(DownloadRepository $downloadRepository, DownloadSupport $downloadSupport, DownloadSupportRoom $downloadSupportRoom)
    {
        $this->downloadRepository = $downloadRepository;
        $this->downloadSupport = $downloadSupport;
        $this->downloadSupportRoom = $downloadSupportRoom;
    }

    public function getInfoTicket($slug, $ticket_id)
    {
        $download = $this->downloadRepository->getPostBySlug($slug)->load('users');
        $ticket = $this->downloadSupport->newQuery()->find($ticket_id)->load('user');
        $rooms = $this->downloadSupportRoom->newQuery()->where('download_support_id', $ticket_id)->get()->load('user', 'author');

        return response()->json([
            "ticket" => $ticket,
            "download" => $download,
            "rooms" => $rooms
        ]);
    }
}
