<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Repository\Account\UserRepository;
use Illuminate\Http\Request;

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
        $user = $this->userRepository->getInfoUser()->update([
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description
        ]);

        if($user->description !== null)
            $this->userRepository->checkedTutoriel($user->id, );


    }
}
