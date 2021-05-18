<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Download\DownloadCategory;
use App\Models\Download\DownloadFeature;
use App\Models\Download\DownloadUser;
use App\Packages\SteamApi\Steam;
use App\Repository\Download\DownloadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

                    toastr()->success("Package créer avec succès", "OK");
                    return redirect()->route('account.packages');
                }catch (\Exception $exception) {
                    Log::error($exception->getMessage());
                    toastr()->error("Erreur lors du traitement de votre package", "Erreur Système");
                    return redirect()->back();
                }
            }catch (\Exception $exception) {
                Log::error($exception->getMessage());
                toastr()->error("Erreur lors du traitement de votre package", "Erreur Système");
                return redirect()->back();
            }
        }catch (\Exception $exception) {
            Log::error($exception->getMessage());
            toastr()->error("Erreur lors du traitement de votre package", "Erreur Système");
            return redirect()->back();
        }
    }
}
