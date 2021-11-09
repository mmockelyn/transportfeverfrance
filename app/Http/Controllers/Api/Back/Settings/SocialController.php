<?php

namespace App\Http\Controllers\Api\Back\Settings;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Notifications\Social\TwitterNotification;
use App\Packages\TwitterApi\TwitterApi;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class SocialController extends Controller
{
    /**
     * @var TwitterApi
     */
    private TwitterApi $twitter;

    public function __construct()
    {
        $this->twitter = new TwitterApi();
    }

    public function posting(Request $request)
    {
        //dd($request->all());

        if($request->file('image')) {
            try {
                $request->file('image')->storeAs('/files/shares/tmp/', $request->file('image')->getClientOriginalName(), 'public');
            }catch (FileException $exception) {
                LogActivity::addToLog($exception->getMessage());
                toastr()->error($exception->getMessage(), "Erreur transfere Fichier");
                return redirect()->back();
            }
        }

        foreach ($request->get('providers') as $provider) {
            switch ($provider) {
                case 'twitter':
                    $follow = Follow::query()->where('slug', 'twitter')->first();
                    try {
                        $request->file('image') ?
                            $this->twitter->postingMessageWithMedia($request->get('body'), ['/files/shares/tmp/'.$request->file('image')->getClientOriginalName()]) :
                            $this->twitter->postingMessageWithoutMedia($request->get('body'));
                        LogActivity::addToLog("News Social Twitter publier");
                        toastr()->success("News Social publier");
                        return redirect()->back();
                    }catch (\Exception $exception) {
                        toastr()->error($exception->getMessage(), "Erreur Notification twitter");
                        LogActivity::addToLog($exception->getMessage());
                        return redirect()->back();
                    }
            }
        }
    }
}
