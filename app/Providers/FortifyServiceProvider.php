<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Helpers\LogActivity;
use App\Models\User;
use App\Models\UserConnectLog;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Stevebauman\Location\Facades\Location;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::authenticateUsing(function (Request $request) {
            try {
                $user = User::query()->where('email', $request->email)->first();

                if($user && Hash::check($request->password, $user->password)) {
                    $this->logStatement($request->ip(), $user->id);
                    LogActivity::addToLog("Connection effectuer");
                    return $user;
                } else {
                    LogActivity::addToLog("Erreur de connexion - Identifiant erronée");
                    toastr()->error("Ces identifiants ne correspondent pas !");
                    return null;
                }

            }catch (\Exception $exception) {
                LogActivity::addToLog("Erreur de connexion: ".$exception->getMessage());
                toastr()->error($exception->getMessage());
                return $exception;
            }
        });


        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function () {
            return view('auth.password-reset');
        });

        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor-challenge');
        });

    }

    private function logStatement($ip, $user_id)
    {
        $locationG = Location::get("176.171.108.192");
        $agent = new \Jenssegers\Agent\Agent;

        if($locationG != false) {
            return UserConnectLog::create([
                "location" => "[".$locationG->countryCode."] - ".$locationG->regionName." - ".$locationG->cityName,
                "device" => $agent->device()." - ".$agent->platform()." - ".$agent->browser(),
                "ip" => $ip,
                "user_id" => $user_id
            ]);
        } else {
            return UserConnectLog::create([
                "location" => "[FR] - Local - DEV",
                "device" => $agent->isDesktop() ? 'Ordinateur' : 'Mobile',
                "ip" => $ip,
                "user_id" => $user_id
            ]);
        }

    }
}
