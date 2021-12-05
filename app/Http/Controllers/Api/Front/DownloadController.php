<?php

namespace App\Http\Controllers\Api\Front;

use App\Helpers\DiscordNotification;
use App\Helpers\Format;
use App\Helpers\LogActivity;
use App\Helpers\TwitterNotification;
use App\Http\Controllers\Controller;
use App\Models\Download\Download;
use App\Models\Download\DownloadCategory;
use App\Models\Download\DownloadComment;
use App\Models\Download\DownloadFeature;
use App\Models\Download\DownloadSubCategory;
use App\Models\Download\DownloadSupport;
use App\Models\Download\DownloadSupportRoom;
use App\Models\Download\DownloadUser;
use App\Models\Download\DownloadVersion;
use App\Models\User;
use App\Notifications\Account\Package\publishModNotification;
use App\Repository\Download\DownloadRepository;
use Atymic\Twitter\Facade\Twitter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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

    private DiscordNotification $discordNotification;

    /**
     * DownloadController constructor.
     * @param DownloadRepository $downloadRepository
     * @param DownloadSupport $downloadSupport
     * @param DownloadSupportRoom $downloadSupportRoom
     * @param DownloadCategory $downloadCategory
     * @param DownloadSubCategory $downloadSubCategory
     * @param DiscordNotification $discordNotification
     */
    public function __construct(DownloadRepository $downloadRepository,
                                DownloadSupport $downloadSupport,
                                DownloadSupportRoom $downloadSupportRoom,
                                DownloadCategory $downloadCategory,
                                DownloadSubCategory $downloadSubCategory, DiscordNotification $discordNotification)
    {
        $this->downloadRepository = $downloadRepository;
        $this->downloadSupport = $downloadSupport;
        $this->downloadSupportRoom = $downloadSupportRoom;
        $this->downloadCategory = $downloadCategory;
        $this->downloadSubCategory = $downloadSubCategory;
        $this->discordNotification = $discordNotification;
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

    public function category($category_id)
    {
        $cat = $this->downloadCategory->newQuery()->find($category_id);

        return response()->json($cat);
    }

    public function updateCategory(Request $request, $category_id)
    {
        try {
            $this->downloadCategory->newQuery()->find($category_id)
                ->update([
                    "title" => $request->get('title'),
                    "slug" => Str::slug($request->get('title'))
                ]);

            toastr()->success("Un catégorie à été mise à jour !");
            return redirect()->back();
        }catch (\Exception $exception) {
            toastr()->error("Erreur lors de la mise à jour d'une catégorie", "Erreur Server");
            return redirect()->back();
        }
    }

    public function deleteCategory($category_id)
    {
        try {
            $this->downloadCategory->newQuery()->find($category_id)
                ->delete();

            return response()->json();
        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function deleteSubCategory($category_id, $sub_id)
    {
        try {
            $this->downloadSubCategory->newQuery()->find($sub_id)
                ->delete();

            return null;
        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
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
                        <button class="btn btn-danger btn-sm deleteSub" data-category-id="<?= $category_id; ?>" data-sub-id="<?= $subcategory->id; ?>"><i class="fa fa-trash"></i> Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                $("#list_subs_categories").DataTable();
            });

            document.querySelectorAll('.deleteSub').forEach(btn => {
                btn.addEventListener('click', e => {
                    e.preventDefault()
                    let modal = $("#list_sub_categories")
                    $.ajax({
                        url: `/api/download/category/${btn.dataset.categoryId}/sub/${btn.dataset.subId}`,
                        method: 'DELETE',
                        success: data => {
                            btn.parentNode.parentNode.style.display = 'none'
                            toastr.success("La sous catégorie à été supprimer");
                        },
                        error: err => {
                            toastr.error(err.responseText, "Erreur Serveur")
                        }
                    })
                })
            })
        </script>
        <?php

        return response()->json(["subs" => $subs->subcategories, "category" => $subs, "content" => ob_get_clean()]);
    }

    public function downloadFeature($download_id)
    {
        $download = Download::query()->find($download_id);

        return response()->json(["feature" => $download->feature, "download" => $download]);
    }

    public function updateDownloadFeature(Request $request, $download_id)
    {
        $download = Download::query()->find($download_id);
        try {
            $f = DownloadFeature::query()->where('download_id', $download_id)->first()->update([
                "type_vehicule" => $request->get('type_vehicule'),
                "conduite_vehicule" => $request->get('conduite_vehicule'),
                "vitesse" => $request->get('vitesse'),
                "performance" => $request->get('performance'),
                "traction" => $request->get('traction'),
                "dispo_start" => $request->get('dispo_start'),
                "dispo_end" => $request->get('dispo_end'),
                "ecartement" => $request->get('ecartement'),
                "capacity" => $request->get('capacity'),
                "pays" => $request->get('pays')
            ]);

            LogActivity::addToLog("Edition des caractéristique pour le mod <strong>{$download->title}</strong>");
            return response()->json(["message" => "Modification des caractéristiques effectuer avec succès"]);
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            return response()->json([
                "message" => "Impossible de mettre à jours le mod",
                "error" => $exception->getMessage(),
                "trace" => $exception->getTrace()
            ]);
        }
    }

    public function publishMod($download_id)
    {
        $download = Download::query()->find($download_id);

        try {
            $download->update([
                "active" => 1
            ]);

            $download->notify(new publishModNotification($download));
            $this->discordNotification->notify(
                "Le mod $download->title à été publier: ".route('front.download.show', $download->slug),
                $download->title,
                "Le mod <strong>".$download->title."</strong> à été publier sur le site transport fever france");
            TwitterNotification::notification("Le mod {$download->title} à été publier ".route('front.download.show', $download->slug),'files/shares/download/'.$download->image);

            LogActivity::addToLog("Publication du mod: {$download->title}");

            return response()->json([
                "message" => "Votre mod à été publier avec succès"
            ]);
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            return response()->json([
                "message" => "Impossible de mettre à jours le mod",
                "error" => $exception->getMessage(),
                "trace" => $exception->getTrace()
            ]);
        }
    }

    public function addAuthor(Request $request, $download_id)
    {
        $download = Download::query()->find($download_id);

        foreach ($request->get('user_id') as $user) {
            DownloadUser::query()->create([
                "download_id" => $download_id,
                "user_id" => $user
            ]);
        }

        $authors = DownloadUser::query()->where('download_id', $download_id)->get();
        $authUser = User::query()->where('id', $request->get('auth_user_id'))->first();
        ob_start();
        ?>
        <?php foreach ($authors as $author): ?>
        <div class="col-md-3 col-sm-6">
            <div class="d-flex align-items-center mb-7 overlay overflow-hidden">
                <!--begin::Avatar-->
                <div class="symbol symbol-50px me-5">
                    <?php if($author->image): ?>
                        <img src="/storage/files/shares/avatar/<?= $author->image ?>>" class="" alt="">
                    <?php else: ?>
                        <img src="/storage/files/shares/avatar/placeholder.png" class="" alt="">
                    <?php endif; ?>
                </div>
                <!--end::Avatar-->
                <!--begin::Text-->
                <div class="flex-grow-1">
                    <a href="#" class="text-dark fw-bolder text-hover-primary fs-6"><?= $author->name; ?></a>
                    <span class="text-muted d-block fw-bold"><?= $author->email; ?></span>
                </div>
                <!--end::Text-->
                <?php if($authUser->id !== $author->id): ?>
                    <div class="overlay-layer bg-dark bg-opacity-25">
                        <a href="#" class="btn btn-primary btn-shadow">Voir le profil</a>
                        <a href="#" class="btn btn-light-danger btn-shadow ms-2">Supprimer</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php
        $content = ob_get_clean();

        return response()->json([
            "message" => "Un ou plusieurs auteur ont été ajouter au mod.",
            "content" => $content
        ]);
    }

    public function publishComment($download_id, $comment_id)
    {
        $down = Download::query()->find($download_id);
        try {
            DownloadComment::query()->find($comment_id)->update([
                "valid" => 1
            ]);
            LogActivity::addToLog("Publication d'un commentaire du mod <strong>{$down->title}</strong>");
            return redirect()->back();
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            return redirect()->back(500);
        }
    }

    public function dispublishComment($download_id, $comment_id)
    {
        $down = Download::query()->find($download_id);
        try {
            DownloadComment::query()->find($comment_id)->update([
                "valid" => 0
            ]);
            LogActivity::addToLog("Annulation de la publication d'un commentaire du mod <strong>{$down->title}</strong>");
            return redirect()->back();
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            return redirect()->back(500);
        }
    }

    public function getVersion($download_id, $version_id)
    {
        $version = DownloadVersion::query()->find($version_id);
        return response()->json([
            "version" => $version,
            "download" => $version->download
        ]);
    }

    public function postVersion(Request $request, $download_id)
    {
        //dd($request->all());
        try {
            $version = DownloadVersion::query()->create([
                "version" => $request->get('version'),
                "content" => $request->get('contents'),
                "type" => $request->get('type'),
                "state" => $request->get('state'),
                "link_packages" => $request->get('link_package'),
                "download_id" => $download_id,
                "user_id" => $request->get('user_id')
            ]);

            if($request->file('file_mod')) {
                try {
                    $file = $request->file('file_mod');
                    $file->storeAs('files/shares/download/files/', $file->getClientOriginalName(), 'public');

                    $version->update([
                        "link_packages" => '/storage/files/shares/download/files/'.$file->getClientOriginalName()
                    ]);

                    LogActivity::addToLog("Ajout d'une nouvelle version pour le mod: {$version->download->title}");
                    return redirect()->back()
                        ->with('toast')
                        ->with('status', 'success')
                        ->with('message', "Une nouvelle version à été créer avec succès pour le mod: {$version->download->title}");
                }catch (FileException $exception) {
                    LogActivity::addToLog($exception->getMessage());
                    return redirect()->back()
                        ->with('toast')
                        ->with('status', 'error')
                        ->with('message', "Erreur lors de la création de la nouvelle version du mod.<br>Consulter les logs");
                }
            } else {
                LogActivity::addToLog("Ajout d'une nouvelle version pour le mod: {$version->download->title}");
                return redirect()->back()
                    ->with('toast')
                    ->with('status', 'success')
                    ->with('message', "Une nouvelle version à été créer avec succès pour le mod: {$version->download->title}");
            }
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            return redirect()->back()
                ->with('toast')
                ->with('status', 'error')
                ->with('message', "Erreur lors de la création de la nouvelle version du mod.<br>Consulter les logs");
        }
    }

    public function updateVersion(Request $request, $download_id, $version_id)
    {
        $version = DownloadVersion::query()->find($version_id);

        try {
            $version->update([
                "version" => $request->get('version'),
                "link_packages" => $request->get('link_package'),
                "content" => $request->get('contents'),
                "type" => $request->get('type'),
                "state" => $request->get('state'),
            ]);

            if($request->get('state') == 2) {
                $version->download()->update([
                    "version_latest" => $request->get('version')
                ]);
            }

            if($request->file('file_mod')) {
                try {
                    $file = $request->file('file_mod');
                    $file->storeAs('files/shares/download/files/', $file->getClientOriginalName(), 'public');

                    $version->update([
                        "link_packages" => '/storage/files/shares/download/files/'.$file->getClientOriginalName()
                    ]);
                    LogActivity::addToLog("Edition d'une version pour le mod: {$version->download->title}");
                    return redirect()->back()
                        ->with('toast')
                        ->with('status', 'success')
                        ->with('message', "La version {$version->version} à été editer avec succès pour le mod: {$version->download->title}");
                }catch (FileException $exception) {
                    Log::error($exception);
                    LogActivity::addToLog($exception->getMessage());
                    return redirect()->back()
                        ->with('toast')
                        ->with('status', 'error')
                        ->with('message', "Erreur lors de la modification de la version du mod.<br>Consulter les logs");
                }
            } else {
                LogActivity::addToLog("Edition d'une version pour le mod: {$version->download->title}");
                return redirect()->back()
                    ->with('toast')
                    ->with('status', 'success')
                    ->with('message', "La version {$version->version} à été editer avec succès pour le mod: {$version->download->title}");
            }
        }catch (\Exception $exception) {
            Log::error($exception);
            LogActivity::addToLog($exception->getMessage());
            return redirect()->back()
                ->with('toast')
                ->with('status', 'error')
                ->with('message', "Erreur lors de la modification de la version du mod.<br>Consulter les logs");
        }
    }
}
