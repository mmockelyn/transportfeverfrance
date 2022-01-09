<?php

namespace App\Providers;

use App\Charts\Blog\BlogCommentChart;
use App\Charts\Blog\BlogViewChart;
use App\Http\ViewComposers\HomeComposer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Studio\Totem\Totem;
use ConsoleTVs\Charts\Registrar as Charts;

class AppServiceProvider extends ServiceProvider
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
     * @param Charts $charts
     * @return void
     */
    public function boot(Charts $charts)
    {
        DB::statement("SET lc_time_names = 'fr_FR'");
        View::composer([
            'front.*',
            'new_front.*',
            'account.profil',
            'account.*',
            'errors.*'
        ], HomeComposer::class);
        \view()->composer('front.layouts.layout', function ($view) {
            $theme = Cookie::get('theme');
            if($theme != 'dark' && $theme != 'light') {
                $theme = 'light';
            }

            $view->with('theme', $theme);
        });

        Totem::auth(function($request) {
            // return true / false . For e.g.
            if(Auth::check()) {
                if(\auth()->user()->group == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        });

        $charts->register([
            BlogViewChart::class,
            BlogCommentChart::class
        ]);
    }
}
