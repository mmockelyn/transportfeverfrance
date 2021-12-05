<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Http;

class DiscordNotification
{
    public function notify($content, $title, $description, $color = '#58b9ff')
    {
        return Http::asForm()->post(config('services.discord.webhook'), [
            "content" => $content,
            "tts" => false,
            "embeds" => [
                [
                    "title" => $title,
                    "description" => $description,
                    "color" => $color
                ]
            ],
        ]);
    }
}
