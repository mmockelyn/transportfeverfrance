<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Download\DownloadCategory;
use App\Models\Download\DownloadSubCategory;
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
     * @var DownloadSubCategory
     */
    private DownloadSubCategory $downloadSubCategory;

    /**
     * DownloadController constructor.
     * @param DownloadRepository $downloadRepository
     * @param DownloadSupport $downloadSupport
     * @param DownloadSupportRoom $downloadSupportRoom
     * @param DownloadCategory $downloadCategory
     * @param DownloadSubCategory $downloadSubCategory
     */
    public function __construct(DownloadRepository $downloadRepository, DownloadSupport $downloadSupport, DownloadSupportRoom $downloadSupportRoom, DownloadCategory $downloadCategory, DownloadSubCategory $downloadSubCategory)
    {
        $this->downloadRepository = $downloadRepository;
        $this->downloadSupport = $downloadSupport;
        $this->downloadSupportRoom = $downloadSupportRoom;
        $this->downloadCategory = $downloadCategory;
        $this->downloadSubCategory = $downloadSubCategory;
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

    public function listSubCategories($category_id)
    {
        $subs = $this->downloadCategory->newQuery()->find($category_id);

        ob_start();
        ?>
        <table id="list_subs_categories" class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>
            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                <th>#</th>
                <th>Titre</th>
                <th class="text-end min-w-100px">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($subs->subcategories as $subcategory): ?>
                <tr>
                    <td><?= $subcategory->id; ?></td>
                    <td><?= $subcategory->title; ?></td>
                    <td class="text-end">
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                $("#list_subs_categories").DataTable();
            });
        </script>
        <?php

        return response()->json(["subs" => $subs->subcategories, "category" => $subs, "content" => ob_get_clean()]);
    }
}
