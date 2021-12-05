<?php


namespace App\Helpers;


use Atymic\Twitter\Facade\Twitter;
use Illuminate\Support\Facades\File;

class TwitterNotification
{
    public static function notification($status, $media = null)
    {
        if ($media !== null) {
            $uploaded_media = Twitter::uploadMedia(['media' => File::get(public_path('storage/'.$media))]);

            Twitter::postTweet(["status" => $status, 'media_ids' => $uploaded_media->media_id_string]);
        } else {
            Twitter::postTweet(["status" => $status]);
        }
    }
}
