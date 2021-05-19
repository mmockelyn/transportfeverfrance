<?php


namespace App\Packages\SteamApi;


use Illuminate\Support\Facades\Http;
use Syntax\SteamApi\Facades\SteamApi;

class Steam
{
    /**
     * @var mixed
     */
    protected $api_key;
    public string $endpoint;
    public string $app_id;

    public function __construct()
    {
        $this->api_key = env('STEAM_API_KEY');
        $this->endpoint = 'https://steam.transportfeverfrance.tk/';
        $this->app_id = '1066780';
    }

}
