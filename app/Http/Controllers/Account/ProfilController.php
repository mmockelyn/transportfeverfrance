<?php

namespace App\Http\Controllers\Account;

use App\Helpers\Format;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdatePasswordRequest;
use App\Jobs\Account\DeleteAccount;
use App\Notifications\Account\UpdateInfoProfil;
use App\Repository\Account\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ProfilController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * ProfilController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $this->getAuthenticated();
        $user = $this->userRepository->getInfoUser(auth()->user()->id);
        $profilPercent = $this->userRepository->getValueCompleteTuto(auth()->user()->id);

        //dd(Format::passwordComplexity('rbU89a-4'));

        return view('account.profil', compact('user', 'profilPercent'));
    }

    public function updateUser(Request $request)
    {
        $this->getAuthenticated();
        try {
            $user = $this->userRepository->getInfoUser()->update([
                'name' => $request->name,
                'email' => $request->email,
                'description' => $request->description
            ]);

            $user = $this->userRepository->getInfoUser();

            if ($user->description !== null)
                $this->userRepository->checkedTutoriel($user->id, 8);

            LogActivity::addToLog("Information de profil mise à jours");
            $user->notify(new UpdateInfoProfil());
            return response()->json();
        } catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            return response()->json();
        }
    }

    public function updateAvatar(Request $request)
    {
        $this->getAuthenticated();
        try {
            $uploadedFile = $request->file('profile_avatar');
            $uploadedFile->storeAs('files/shares/avatar/', $uploadedFile->getClientOriginalName(), 'public');

            $this->userRepository->getInfoUser()->update([
                'avatar' => Storage::url('files/shares/avatar/' . $uploadedFile->getClientOriginalName())
            ]);

            $user = $this->userRepository->getInfoUser();

            if ($user->avatar !== null)
                $this->userRepository->checkedTutoriel($user->id, 2);

            LogActivity::addToLog("Avatar mis à jours");
            $user->notify(new UpdateInfoProfil());
            return redirect()->back();
        } catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            return redirect()->back();
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $this->getAuthenticated();

        $user = $this->userRepository->getInfoUser();

        if($user->password != null) {
            if (Hash::check($request->old_password, $user->password) == true) {
                try {
                    $complexity = Format::passwordComplexity($request->password);
                    $user->update([
                        "password" => Hash::make($request->password),
                        "password_complexity" => $complexity
                    ]);

                    LogActivity::addToLog("Mot de passe mis à jour");
                    return response()->json();
                } catch (\Exception $exception) {
                    LogActivity::addToLog($exception->getMessage());
                    return response()->json(null, 500);
                }
            } else {
                LogActivity::addToLog("Erreur lors de la mise à jours du mot de passe");
                return response()->json(null, 900);
            }
        } else {
            try {
                $complexity = Format::passwordComplexity($request->password);
                $user->update([
                    "password" => Hash::make($request->password),
                    "password_complexity" => $complexity
                ]);

                LogActivity::addToLog("Mot de passe mis à jour");
                return response()->json();
            } catch (\Exception $exception) {
                LogActivity::addToLog($exception->getMessage());
                return response()->json(null, 500);
            }
        }
    }

    public function deleteAccount(Request $request)
    {
        $this->getAuthenticated();
        $user = $this->userRepository->getInfoUser();
        if(Hash::check($request->password, $user->password) == true) {
            $job = (new DeleteAccount($user->id))->delay(now()->addDays(5));
            $job_id = $this->dispatch($job);
            $this->userRepository->getInfoUser()->update([
                "deleted_at" => now()->addDays(5),
                "deleted_job_id" => $job_id
            ]);

            return response()->json();
        } else {
            LogActivity::addToLog("Erreur lors de la suppression du compte");
            return response()->json(null, 500);
        }
    }
}
