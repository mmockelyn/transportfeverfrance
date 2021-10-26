<?php

namespace App\Http\Controllers\Back\Settings;

use App\Helpers\Format;
use App\Http\Controllers\Controller;
use App\Models\Account\UserDeviceToken;
use App\Models\User;
use App\Models\UserSocial;
use App\Notifications\Back\Setting\User\NewUserWithoutPassword;
use App\Repository\Account\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createNewUser(Request $request)
    {
        //dd($request->all());

        $password = Str::random(8);
        $password_complex = Format::passwordComplexity($password);

        try {
            $user = User::create([
                "name" => $request->get('name'),
                "email" => $request->get('email'),
                "group" => $request->get('user_role'),
                "password" => Hash::make($password),
                "email_verified_at" => now(),
                "valid" => 1,
                "password_complexity" => $password_complex
            ]);

            UserSocial::create([
                "user_id" => $user->id
            ]);

            UserDeviceToken::create([
                "user_id" => $user->id
            ]);

            $this->userRepository->storeInvolveTutoWrapper($user->id);

            $user->notify(new NewUserWithoutPassword($user, $password));

            return response()->json($user);
        }catch (\Exception $exception) {
            return response()->json(["error" => $exception->getMessage()], 500);
        }
    }

    public function index()
    {
        return view('back.settings.users.index', [
            "users" => User::all()
        ]);
    }
}
