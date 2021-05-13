<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Repository\Account\UserRepository;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function get($user_id)
    {
        $user = $this->userRepository->getInfoUser($user_id)->load('blogcomments', 'downloadcomments', 'downloadsupports', 'tutorials');

        return response()->json(['user' => $user]);
    }

    public function inbox($user_id)
    {
        dd();
    }

    public function list()
    {
        $users = $this->userRepository->listingUsersOutActual();

        return response()->json(['users' => $users]);
    }

    public function packages($user_id)
    {
        $user = $this->userRepository->getInfoUser($user_id)->load('downloads');
        $packages = $user->downloads;
        $array = [];

        foreach ($packages as $package) {
            $array[] = [
                "id" => $package->id,
                "title" => $package->title,
                "provider" => $package->provider,
                "state" => $package->active,
                "shortDescription" => $package->short_content,
                "description" => $package->content,
                "versionLatest" => $package->version_latest,
                "countView" => $package->count_view,
                "count_download" => $package->count_download,
                "imgFile" => env('APP_URL').'/storage/files/shares/download/'.$package->image,
                "category" => $package->category,
                "subcategory" => $package->subcategory,
                'actions' => null,
            ];
        }

        return response()->json([
            "data" => $array
        ]);
    }


}
