<?php


namespace App\Packages\TwitterApi;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterApi
{
    private $access_token;

    public function __construct()
    {
        $oauth = new TwitterOAuth(config('services.twitter.client_id'), config('services.twitter.client_secret'));
        $accessToken = $oauth->oauth2('oauth2/token', ['grant_type' => 'client_credentials']);
        $this->access_token = $accessToken->access_token;

        $this->twitter = new TwitterOAuth(config('services.twitter.client_id'), config('services.twitter.client_secret'), config('services.twitter.access_token'), config('services.twitter.access_token_secret'));
    }

    public function getUserTimeline()
    {
        $tweets = $this->twitter->get('statuses/user_timeline',[
            'screen_name' => "trainznation",
            'exclude_replies' => true,
            'count' => 50
        ]);

        return $tweets;
    }

    public function postingMessageWithoutMedia($message)
    {
        return $this->twitter->post('statuses/update', ['status' => $message]);
    }

    public function postingMessageWithMedia($message, array $mediaFiles = null)
    {
        $media_ids = [];
        foreach ($mediaFiles as $k => $mediaFile) {
            $media = $this->twitter->upload('media/upload', ["media" => $mediaFile]);
            $media_ids[$k] = $media->media_id_string;
        }
        dd($media_ids);

        $parameters = [
            "status" => $message,
            "media_ids" => implode(',', $media_ids)
        ];

        return $this->twitter->post('statuses/update', $parameters);

    }
}
