<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\Inbox;
use App\Notifications\Account\NewMessageFrom;
use App\Repository\Account\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $users = $this->userRepository->listingUsersOutActual();
        $inboxes = $this->userRepository->getInfoUser()->load('inboxes');

        return view('account.messagerie', compact('inboxes', 'users'));
    }

    public function show($message_id)
    {
        $users = $this->userRepository->listingUsersOutActual();
        $message = $this->inbox->newQuery()->find($message_id);

        if ($message->read_at == null) {
            $message->update([
                "read_at" => now()
            ]);
        }

        return view('account.messagerieView', compact('message', 'users'));
    }

    public function compose()
    {
        $user = $this->userRepository->getInfoUser();

        return view('account.messagerieCompose', compact('user'));
    }

    public function sending(Request $request)
    {
        try {
            $message = $this->inbox->newQuery()->create([
                "subject" => $request->subject,
                "message" => $request->message,
                "from_id" => auth()->user()->id,
                "to_id" => $request->to_id
            ]);

            try {
                $message->to->notify(new NewMessageFrom($message));
            }catch (\Exception $exception) {
                Log::error($exception->getMessage());
                return response()->json(null, 500);
            }

            return response()->json(null, 200);
        }catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(null, 500);
        }
    }

    public function delete($messagerie_id)
    {
        $this->inbox->newQuery()->find($messagerie_id)->delete();

        return response()->json();
    }
}
