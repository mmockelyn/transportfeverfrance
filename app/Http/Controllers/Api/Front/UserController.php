<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Account\Conversation;
use App\Models\Account\Message;
use App\Repository\Account\UserRepository;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Nahid\Talk\Facades\Talk;

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


}
