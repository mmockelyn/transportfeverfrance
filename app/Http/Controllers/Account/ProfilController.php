<?php

namespace App\Http\Controllers\Account;

use App\Helpers\Format;
use App\Http\Controllers\Controller;
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
        $user = $this->userRepository->getInfoUser(auth()->user()->id);
        $profilPercent = $this->userRepository->getValueCompleteTuto(auth()->user()->id);

        //dd(Format::passwordComplexity('rbU89a-4'));

        return view('account.profil', compact('user', 'profilPercent'));
    }

    public function updateUser(Request $request)
    {
        try {
            $user = $this->userRepository->getInfoUser()->update([
                'name' => $request->name,
                'email' => $request->email,
                'description' => $request->description
            ]);

            $user = $this->userRepository->getInfoUser();

            if ($user->description !== null)
                $this->userRepository->checkedTutoriel($user->id, 8);

            $user->notify(new UpdateInfoProfil());
            return response()->json();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json();
        }
    }

    public function updateAvatar(Request $request)
    {
        try {
            $uploadedFile = $request->file('profile_avatar');
            $uploadedFile->storeAs('files/shares/avatar/', $uploadedFile->getClientOriginalName(), 'public');

            $this->userRepository->getInfoUser()->update([
                'avatar' => Storage::url('files/shares/avatar/' . $uploadedFile->getClientOriginalName())
            ]);

            $user = $this->userRepository->getInfoUser();

            if ($user->avatar !== null)
                $this->userRepository->checkedTutoriel($user->id, 2);

            $user->notify(new UpdateInfoProfil());
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back();
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            Validator::make($request->all(), [
                'password' => ['required', 'confirmed', Password::min(6)->letters()->mixedCase()->numbers()->symbols()]
            ])->validate();
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 422);
        }
        $user = $this->userRepository->getInfoUser();

        if (Hash::check($request->old_password, $user->password) == true) {
            try {
                $complexity = Format::passwordComplexity($request->password);
                $user->update([
                    "password" => Hash::make($request->password),
                    "password_complexity" => $complexity
                ]);

                return response()->json();
            } catch (\Exception $exception) {
                return response()->json(null, 500);
            }
        } else {
            return response()->json(null, 900);
        }
    }

    public function deleteAccount(Request $request)
    {
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
            return response()->json(null, 500);
        }
    }
}
