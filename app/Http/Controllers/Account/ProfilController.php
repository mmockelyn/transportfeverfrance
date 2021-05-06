<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Notifications\Account\UpdateInfoProfil;
use App\Repository\Account\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

//        /dd($user->downloads()->orderBy('updated_at', 'desc')->limit(5)->get());

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

            if($user->description !== null)
                $this->userRepository->checkedTutoriel($user->id, 8);

            $user->notify(new UpdateInfoProfil());
            return response()->json();
        }catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json();
        }
    }
}
