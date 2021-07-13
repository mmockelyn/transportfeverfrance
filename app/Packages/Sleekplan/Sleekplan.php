<?php


namespace App\Packages\Sleekplan;


use Illuminate\Support\Facades\Http;

class Sleekplan
{
    /**
     * @var mixed
     */
    private string $endpoint;

    public function __construct()
    {
        $this->endpoint = "https://app.olvy.co/api/v1";
    }

    public function call($method, $uri, $args = [])
    {
        switch ($method) {
            case 'get':
                $response = Http::get($this->endpoint.$uri, $args);
                return $response->object();
                break;

            case 'post':
                $response = Http::post($this->endpoint.$uri, $args);
                return $response->object();
                break;

            case 'put':
                $response = Http::put($this->endpoint.$uri, $args);
                return $response->object();
                break;

            case 'delete':
                $response = Http::delete($this->endpoint.$uri, $args);
                return $response->object();
                break;

            default:
                return response()->json(["data" => null]);
        }
    }
}
