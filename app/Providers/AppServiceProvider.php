<?php

namespace App\Providers;

use App\Http\ViewComposers\HomeComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
     * @return void
     */
    public function boot()
    {
        View::composer(['front.layouts.layout', 'front.index', 'front.blog.index', 'front.blog.category', 'front.blog.show'], HomeComposer::class);
    }
}
