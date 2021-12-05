<?php

namespace App\Http\Controllers\Account;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Download\Download;
use App\Models\Download\DownloadCategory;
use App\Models\Download\DownloadFeature;
use App\Models\Download\DownloadSubCategory;
use App\Models\Download\DownloadSupport;
use App\Models\Download\DownloadSupportRoom;
use App\Models\Download\DownloadUser;
use App\Models\Download\DownloadWiki;
use App\Packages\SteamApi\Steam;
use App\Repository\Download\DownloadRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
        if(auth()->guest()) {
            return redirect()->route('login');
        }
    }


    public function index()
    {
        $this->getAuthenticated();
        $user = auth()->user();
        return view('account.package.index', compact('user'));
    }


    public function create()
    {
        $this->getAuthenticated();
        $categories = DownloadCategory::all();
        return view('account.package.create', compact('categories'));
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $this->getAuthenticated();
        $category = DownloadCategory::find($request->get('category_id'));
        $subcategory = DownloadSubCategory::find($request->get('subcategory_id'));
        try {
            $download = Download::query()->create([
                "title" => $request->get('title'),
                "slug" => Str::slug($request->get('title')),
                "provider" => $request->get('provider'),
                "seo_title" => "{$category->title} - {$subcategory->title} - {$request->get('title')}",
                "short_content" => $request->get('short_content'),
                "content" => $request->get('description'),
                "meta_description" => Str::limit($request->get('description'), 125, ''),
                "meta_keywords" => $request->get('meta_keywords'),
                "licence" => $request->get('licence'),
                "download_category_id" => $request->get('category_id'),
                "download_sub_category_id" => $request->get('subcategory_id')
            ]);

            try {
                $feature = DownloadFeature::query()->create([
                    "type_feature" => $request->get('type_feature'),
                    "type_vehicule" => $request->get('type_vehicule'),
                    "conduite_vehicule" => $request->get('type_conduite'),
                    "vitesse" => $request->get('vitesse'),
                    "performance" => $request->get('performance'),
                    "traction" => $request->get('traction'),
                    "dispo_start" => $request->get('dispo_start'),
                    "dispo_end" => $request->get('dispo_end'),
                    "ecartement" => $request->get('ecartement'),
                    "capacity" => $request->get('capacity'),
                    "pays" => $request->get('pays'),
                    "download_id" => $download->id
                ]);

                try {
                    $author = DownloadUser::query()->create([
                        "download_id" => $download->id,
                        "user_id" => auth()->user()->id
                    ]);
                    try {
                        DownloadWiki::query()->create([
                            "content" => "null",
                            "active" => 0,
                            "download_id" => $download->id
                        ]);
                        LogActivity::addToLog("Création du mod $download->title");
                        return response()->json([
                            "message" => "Vous avez créer le mod $download->title.<br>Vous pouvez voir sa fiche <a href='".route('account.packages.show', $download->id)."'>ici</a>"
                        ]);
                    }catch (\Exception $exception) {
                        LogActivity::addToLog($exception->getMessage());
                        return response()->json([
                            "message" => "Impossible de définir la documentation du mod",
                            "error" => $exception->getMessage(),
                            "trace" => $exception->getTrace()
                        ]);
                    }
                }catch (\Exception $exception) {
                    LogActivity::addToLog($exception->getMessage());
                    return response()->json([
                        "message" => "Impossible de définir l'auteur du mod",
                        "error" => $exception->getMessage(),
                        "trace" => $exception->getTrace()
                    ]);
                }
            }catch (\Exception $exception) {
                LogActivity::addToLog($exception->getMessage());
                return response()->json([
                    "message" => "Impossible de définir les features du mod",
                    "error" => $exception->getMessage(),
                    "trace" => $exception->getTrace()
                ]);
            }
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            return response()->json([
                "message" => "Impossible de créer le mod",
                "error" => $exception->getMessage(),
                "trace" => $exception->getTrace()
            ]);
        }
    }

    public function show($packages_id)
    {
        $this->getAuthenticated();
        $download = Download::find($packages_id);
        //dd($download->wiki);

        return view('account.package.show', compact('download'));
    }

    public function update_image(Request $request, $package_id)
    {
        $this->getAuthenticated();
        $name_file = "img".$package_id.'.png';
        $download = Download::find($package_id);
        try {
            $file = $request->file('image')->storePubliclyAs('files/shares/download/', $name_file, 'public');
            $download->update([
                "image" => $name_file
            ]);

            LogActivity::addToLog("Image du mod $download->title mis à jours");
            toastr()->success("Image du mod mise à jours", "OK");
            return redirect()->back();
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            toastr()->error("Erreur lors du traitement de votre package", "Erreur Système");
            return redirect()->back();
        }
    }

    public function update_info(Request $request, $package_id)
    {
        $this->getAuthenticated();
        $download = Download::find($package_id);

        if($download->active == 1) {
            return response()->json([
                "code" => "W202",
                "message" => "Le mod est actuellement publier et ne peut pas être modifier.<br>Pour modifier le mod, veuillez le dépublier."
            ], 200);
        }

        try {
            $download->update([
                "title" => $request->title,
                "slug" => Str::slug($request->title),
                "seo_title" => "{$download->category->title} - {$download->category->title} - {$request->title}",
                "short_content" => $request->short_content,
                "content" => $request->description,
                "meta_keywords" => $request->meta_keywords
            ]);

            LogActivity::addToLog("Information du mod $download->title mis à jours");
            return response()->json([
                "message" => "Le mod $download->title à été mis à jours"
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

    public function showSteam($download_id)
    {
        $download = Download::query()->find($download_id);

        return view("account.package.steam", [
            "download" => $download
        ]);
    }

    public function showTicket($download_id, $ticket_id)
    {
        Carbon::setLocale('fr_FR');
        $ticket = DownloadSupport::query()->find($ticket_id);

        return view('account.package.room', [
            "ticket" => $ticket
        ]);
    }

    public function postTicket(Request $request, $download_id, $ticket_id)
    {
        try {
            $room = DownloadSupportRoom::query()->create([
                "message" => $request->get('message'),
                "user_id" => auth()->user()->id,
                "download_support_id" => $ticket_id
            ]);

            try {
                $room->ticket()->update([
                    "state" => 1
                ]);
                LogActivity::addToLog("Poste d'un message sur le mod N° {$download_id}");
                return redirect()->back()
                    ->with('toast')
                    ->with('status', 'success')
                    ->with('message', "Poste d'un message sur le mod N° {$download_id}");
            }catch (\Exception $exception) {
                LogActivity::addToLog($exception->getMessage());
                return redirect()->back()
                    ->with('toast')
                    ->with('status', 'error')
                    ->with('message', "Erreur Système");
            }
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            return redirect()->back()
                ->with('toast')
                ->with('status', 'error')
                ->with('message', "Erreur Système");
        }
    }

    public function closureTicket(Request $request, $download_id, $ticket_id)
    {
        try {
            $room = DownloadSupport::query()->find($ticket_id);
            $room->update([
                "state" => 3
            ]);
            LogActivity::addToLog("Cloture du ticket TCK-MOD{$room->download_id}-{$ticket_id}");
            return response()->json([
                "message" => "Ticket N°TCK-MOD{$room->download_id}-{$ticket_id} cloturer"
            ]);
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            return response()->json([
                "message" => "Erreur Système",
                "error" => $exception->getMessage(),
                "trace" => $exception->getTrace()
            ]);
        }
    }
}
