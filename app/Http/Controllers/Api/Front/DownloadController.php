<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Download\DownloadCategory;
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
     * @var DownloadCategory
     */
    private DownloadCategory $downloadCategory;

    /**
     * DownloadController constructor.
     * @param DownloadRepository $downloadRepository
     * @param DownloadSupport $downloadSupport
     * @param DownloadSupportRoom $downloadSupportRoom
     * @param DownloadCategory $downloadCategory
     */
    public function __construct(DownloadRepository $downloadRepository, DownloadSupport $downloadSupport, DownloadSupportRoom $downloadSupportRoom, DownloadCategory $downloadCategory)
    {
        $this->downloadRepository = $downloadRepository;
        $this->downloadSupport = $downloadSupport;
        $this->downloadSupportRoom = $downloadSupportRoom;
        $this->downloadCategory = $downloadCategory;
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

    public function composer(Request $request, $slug, $ticket_id)
    {
        $this->downloadSupportRoom->newQuery()->create([
            "message" => $request->message,
            "user_id" => $request->user_id,
            "download_support_id" => $ticket_id
        ]);

        return response()->json();
    }

    public function close($slug, $ticket_id)
    {
        $this->downloadSupport->newQuery()->find($ticket_id)->update([
            "state" => 3
        ]);

        return response()->json();
    }

    public function searchCategory($category_id)
    {
        $subs = $this->downloadCategory->newQuery()->find($category_id);

        return response()->json(["subs" => $subs->subcategories]);
    }
}
