<?php


namespace App\Http\ViewComposers;


use App\Models\Blog\BlogCategory;
use App\Models\Download\Download;
use App\Models\Download\DownloadCategory;
use App\Models\Follow;
use App\Models\Page;
use App\Models\Site;
use App\Models\User;
use Illuminate\View\View;

class HomeComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with([
            'categories' => BlogCategory::has('blogs')->get(),
            'pages' => Page::select('slug', 'title')->get(),
            'download_categories' => DownloadCategory::all(),
            'follows' => Follow::all(),
            'providers' => config('app.social_provider_active'),
            'authors' => User::where('id', '!=', 1)->get(),
            'site' => Site::query()->where('id', 1)->first(),
            'download_feats' => Download::query()->latest()->limit(6)->get()
        ]);

        if(!auth()->guest()) {
            $view->with([
                'user' => auth()->user(),
                'authors' => User::where('id', '!=', 1)->get()
            ]);
        }
    }
}
