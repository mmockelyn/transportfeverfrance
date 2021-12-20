<?php

namespace App\Http\Controllers\Auth;

use App\Events\newUser;
use App\Http\Controllers\Controller;
use App\Models\Account\UserDeviceToken;
use App\Models\User;
use App\Repository\Account\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use NotificationChannels\Discord\Discord;

class LoginSocialController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * LoginSocialController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function redirectToProvider($provider)
    {
        if($provider === 'discord') {
            return Socialite::driver($provider)->scopes(
                [
                    'identify',
                    'email',
                    'connections',
                ]
            )->redirect();
        } else {
            return Socialite::driver($provider)->redirect();
        }
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $exception) {
            return redirect('/login')->with('status', 'Erreur de connexion avec le provider !');
        }

        switch ($provider) {
            case 'facebook':
                $this->registerFacebook($user);
                event(new newUser($user));
                return redirect()->to('/');
                break;
            case 'google':
                $this->registerGoogle($user);
                return redirect()->to('/');
                break;
            case 'twitter':
                $this->registerTwitter($user);
                return redirect()->to('/');
                break;
            case 'steam':
                $this->registerSteam($user);
                return redirect()->to('/');
                break;
            case 'discord':
                $this->registerDiscord($user);
                return redirect()->to('/');
                break;
            default:
                return redirect()->to('/');
        }
    }

    private function registerFacebook($user)
    {
        $existing_user = User::where('email', $user->email)->first();

        if ($existing_user) {
            auth()->login($existing_user, true);
        } else {
            $newUser = new User;

            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->avatar = $user->avatar;
            $newUser->type = 1;
            $newUser->save();

            DB::table('user_social')->insert([
                "user_id" => $newUser->id,
                "facebook_id" => $user->id
            ]);

            UserDeviceToken::query()->create([
                "user_id" => $newUser->id
            ]);
            $this->includeTutoProfil($newUser->id);

            auth()->login($newUser, true);

            event(new newUser($newUser));
        }

        return redirect()->to('/');
    }

    private function registerGoogle($user)
    {
        $existing_user = User::where('email', $user->email)->first();

        if ($existing_user) {
            auth()->login($existing_user, true);
        } else {
            $newUser = new User;

            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->avatar = $user->avatar;
            $newUser->type = 1;
            $newUser->save();

            DB::table('user_social')->insert([
                "user_id" => $newUser->id,
                "google_id" => $user->id
            ]);

            UserDeviceToken::query()->create([
                "user_id" => $newUser->id
            ]);

            $this->includeTutoProfil($newUser->id);
            $newUser->sendEmailVerificationNotification();

            auth()->login($newUser, true);

            event(new newUser($newUser));
        }

        return redirect()->to('/');
    }

    private function registerTwitter($user)
    {
        $existing_user = User::where('email', $user->email)->first();

        if($user->email == null) {
            $email = $user->nickname.'@transportfeverfrance.fr';
        } else {
            $email = $user->email;
        }

        if ($existing_user) {
            auth()->login($existing_user, true);
        } else {
            $newUser = new User;

            $newUser->name = $user->name;
            $newUser->email = $email;
            $newUser->avatar = $user->avatar;
            $newUser->type = 1;
            $newUser->save();

            DB::table('user_social')->insert([
                "user_id" => $newUser->id,
                "twitter_id" => $user->id
            ]);

            UserDeviceToken::query()->create([
                "user_id" => $newUser->id
            ]);

            $this->includeTutoProfil($newUser->id);

            $newUser->sendEmailVerificationNotification();

            auth()->login($newUser, true);

            event(new newUser($newUser));
        }

        return redirect()->to('/');
    }

    private function registerSteam($user)
    {
        if(!$user->email){
            $email = Str::slug($user->nickname)."@none.tf";
            $existing_user = User::where('email', $email)->first();
        } else {
            $email = $user->email;
            $existing_user = User::where('email', $user->email)->first();
        }


        if ($existing_user) {
            auth()->login($existing_user, true);
        } else {
            $newUser = new User;

            $newUser->name = $user->nickname;
            $newUser->email = $email;
            $newUser->avatar = $user->avatar;
            $newUser->type = 1;
            (!$user->email) ? $newUser->email_verified_at = now() : null;
            (!$user->email) ? $newUser->valid = 1 : null;
            $newUser->save();

            DB::table('user_social')->insert([
                "user_id" => $newUser->id,
                "Steam_id" => $user->id
            ]);

            UserDeviceToken::query()->create([
                "user_id" => $newUser->id
            ]);

            $this->includeTutoProfil($newUser->id);

            $newUser->sendEmailVerificationNotification();

            auth()->login($newUser, true);

            event(new newUser($newUser));
        }

        return redirect()->to('/');
    }

    private function registerDiscord($user)
    {
        if(!$user->email){
            $email = $user->nickname."@none.tf";
            $existing_user = User::where('email', $email)->first();
        } else {
            $email = $user->email;
            $existing_user = User::where('email', $user->email)->first();
        }


        if ($existing_user) {
            auth()->login($existing_user, true);
        } else {
            $newUser = new User;

            $newUser->name = $user->name;
            $newUser->email = $email;
            $newUser->avatar = $user->avatar;
            $newUser->type = 1;
            (!$user->email) ? $newUser->email_verified_at = now() : null;
            (!$user->email) ? $newUser->valid = 1 : null;
            $newUser->save();

            DB::table('user_social')->insert([
                "user_id" => $newUser->id,
                "discord_user_id" => $user->id,
                "discord_private_channel_id" => app(Discord::class)->getPrivateChannel($user->id)
            ]);

            UserDeviceToken::query()->create([
                "user_id" => $newUser->id
            ]);

            $this->includeTutoProfil($newUser->id);

            $newUser->sendEmailVerificationNotification();

            auth()->login($newUser, true);

            event(new newUser($newUser));
        }

        return redirect()->to('/');
    }

    private function includeTutoProfil($user_id)
    {
        $this->userRepository->storeInvolveTutoWrapper($user_id);
    }
}
