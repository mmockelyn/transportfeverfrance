<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use NotificationChannels\Discord\Discord;

class LoginSocialController extends Controller
{
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
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $exception) {
            dd($exception);
            return redirect('/login')->with('status', 'Erreur de connexion avec le provider !');
        }

        switch ($provider) {
            case 'facebook':
                $this->registerFacebook($user);
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
                //return redirect()->to('/');
                break;
            default:
                //return redirect()->to('/');
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
            $newUser->save();

            DB::table('user_social')->insert([
                "user_id" => $newUser->id,
                "facebook_id" => $user->id
            ]);

            auth()->login($newUser, true);
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
            $newUser->save();

            DB::table('user_social')->insert([
                "user_id" => $newUser->id,
                "google_id" => $user->id
            ]);

            auth()->login($newUser, true);
        }

        return redirect()->to('/');
    }

    private function registerTwitter($user)
    {
        $existing_user = User::where('email', $user->email)->first();

        if ($existing_user) {
            auth()->login($existing_user, true);
        } else {
            $newUser = new User;

            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->avatar = $user->avatar;
            $newUser->save();

            DB::table('user_social')->insert([
                "user_id" => $newUser->id,
                "twitter_id" => $user->id
            ]);

            auth()->login($newUser, true);
        }

        return redirect()->to('/');
    }

    private function registerSteam($user)
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
            $newUser->save();

            DB::table('user_social')->insert([
                "user_id" => $newUser->id,
                "Steam_id" => $user->id
            ]);

            auth()->login($newUser, true);
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

        dd($user, $existing_user);


        if ($existing_user) {
            auth()->login($existing_user, true);
        } else {
            $newUser = new User;

            $newUser->name = $user->name;
            $newUser->email = $email;
            $newUser->avatar = $user->avatar;
            $newUser->save();

            DB::table('user_social')->insert([
                "user_id" => $newUser->id,
                "discord_user_id" => $user->id,
                "discord_private_channel_id" => app(Discord::class)->getPrivateChannel($user->id)
            ]);

            auth()->login($newUser, true);
        }

        //return redirect()->to('/');
    }
}
