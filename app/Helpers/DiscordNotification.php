<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Http;

class DiscordNotification
{
    public function notify($content, $title, $description, $color = '#58b9ff')
    {
        return Http::asForm()->post('https://discord.com/api/webhooks/916783272053313606/fUaSjOOP8Sha72xlV0kIOU8tXnYw_o2RR2ISxRDtZFMnq_HGhSg5g5B-408E0UWzoWS7', [
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
