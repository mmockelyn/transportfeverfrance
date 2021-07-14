<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Packages\Sleekplan\Sleekplan;
use Illuminate\Http\Request;

class BackController extends Controller
{
    public function index()
    {
        return view('back.index');
    }

    public function changelog()
    {
        $sleek = new Sleekplan();
        $re = $sleek->call('get', '/organisations/tpffrance/public/release_notes');
        $data = collect($re->results);

        //dd($data->sortBy('published_at'));

        return view('back.changelog', [
            "changelogs" => $data->sortBy('published_at')
        ]);
    }
}
