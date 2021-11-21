<?php

namespace App\Http\Controllers\Account;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Download\Download;
use App\Models\Download\DownloadCategory;
use App\Models\Download\DownloadFeature;
use App\Models\Download\DownloadUser;
use App\Packages\SteamApi\Steam;
use App\Repository\Download\DownloadRepository;
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
        //dd(auth()->user()->downloads);
        return view('account.package.index');
    }


    public function create()
    {
        $this->getAuthenticated();
        return view('account.package.create');
    }

    public function createTffrance()
    {
        $this->getAuthenticated();
        $categories = DownloadCategory::all();
        return view('account.package.createTffrance', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->getAuthenticated();
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

            try {
                $feature = DownloadFeature::create([
                    "download_id" => $download->id,
                    "type_feature" => $request->type_feature,
                    "type_vehicule" => $request->type_vehicule,
                    "conduite_vehicule" => $request->conduite_vehicule,
                    "vitesse" => $request->vitesse,
                    "performance" => $request->performance,
                    "traction" => $request->traction,
                    "dispo_start" => $request->dispo_start,
                    "dispo_end" => $request->dispo_end,
                    "ecartement" => $request->ecartement,
                    "capacity" => $request->capacity,
                    "pays" => $request->pays,
                ]);

                try {
                    $author = DownloadUser::create([
                        "download_id" => $download->id,
                        "user_id" => auth()->user()->id
                    ]);
                    LogActivity::addToLog("Le Package <strong>".$request->title."</strong> à été ajouter.");
                    toastr()->success("Package créer avec succès", "OK");
                    return redirect()->route('account.packages');
                }catch (\Exception $exception) {
                    LogActivity::addToLog($exception->getMessage());
                    toastr()->error("Erreur lors du traitement de votre package", "Erreur Système");
                    return redirect()->back();
                }
            }catch (\Exception $exception) {
                LogActivity::addToLog($exception->getMessage());
                toastr()->error("Erreur lors du traitement de votre package", "Erreur Système");
                return redirect()->back();
            }
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            toastr()->error("Erreur lors du traitement de votre package", "Erreur Système");
            return redirect()->back();
        }
    }

    public function show($packages_id)
    {
        $this->getAuthenticated();
        $download = Download::find($packages_id);

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
            toastr()->success("Information du mod mis à jour", "OK");
            return redirect()->back();
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            toastr()->error("Erreur lors du traitement de votre package", "Erreur Système");
            return redirect()->back();
        }
    }
}
