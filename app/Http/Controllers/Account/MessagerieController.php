<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\Inbox;
use App\Repository\Account\UserRepository;
use Illuminate\Http\Request;
use Nahid\Talk\Facades\Talk;

class MessagerieController extends Controller
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    /**
     * @var Inbox
     */
    private Inbox $inbox;

    /**
     * MessagerieController constructor.
     * @param UserRepository $userRepository
     * @param Inbox $inbox
     */
    public function __construct(UserRepository $userRepository, Inbox $inbox)
    {
        $this->userRepository = $userRepository;
        $this->inbox = $inbox;
    }

    public function index()
    {
        $inboxes = $this->userRepository->getInfoUser()->load('inboxes');

        //dd($inboxes);

        return view('account.messagerie', compact('inboxes'));
    }

    public function show($message_id)
    {
        $message = $this->inbox->newQuery()->find($message_id);

        if($message->read_at == null) {
            $message->update([
                "read_at" => now()
            ]);
        }

        return view('account.messagerieView', compact('message'));
    }

    public function compose()
    {
        $user = $this->userRepository->getInfoUser();

        return view('account.messagerieCompose', compact('user'));
    }

    public function delete($messagerie_id)
    {
        $this->inbox->newQuery()->find($messagerie_id)->delete();

        return response()->json();
    }
}
