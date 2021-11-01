<?php

namespace App\Http\Controllers\Account;

use App\Helpers\LogActivity;
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
        $count = $this->inbox->newQuery()->where('from_id', auth()->user()->id)->where('read_at', null)->get()->count();
        $users = $this->userRepository->listingUsersOutActual();
        $inboxes = $this->userRepository->getInfoUser()->load('inboxes');

        return view('account.messagerie', compact('inboxes', 'users', 'count'));
    }

    public function sentbox()
    {
        $count = $this->inbox->newQuery()->where('from_id', auth()->user()->id)->where('read_at', null)->get()->count();
        $users = $this->userRepository->listingUsersOutActual();
        $sentboxes = $this->inbox->newQuery()->where('from_id', auth()->user()->id)->get();

        return view('account.messagerieSent', compact('sentboxes', 'users', 'count'));
    }

    public function show($message_id)
    {
        $count = $this->inbox->newQuery()->where('from_id', auth()->user()->id)->where('read_at', null)->get()->count();
        $users = $this->userRepository->listingUsersOutActual();
        $message = $this->inbox->newQuery()->find($message_id);

        if ($message->read_at == null) {
            $message->update([
                "read_at" => now()
            ]);
        }

        return view('account.messagerieView', compact('message', 'users', 'count'));
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
                return response()->json(null);
            }

            LogActivity::addToLog("Envoie d'un message à ".$request->to_id->name);
            return response()->json(null);
        }catch (\Exception $exception) {
            LogActivity::addToLog("Messagerie: ".$exception->getMessage());
            Log::error($exception->getMessage());
            return response()->json(null);
        }
    }

    public function viewCompose(Request $request, $message_id)
    {

        try {
            $message = $this->inbox->newQuery()->find($message_id);
            ob_start();
            ?>
            <strong>Message Précédent:</strong><br>
            <?= $message->message; ?>
            <br><br>
            <hr>
            <?= $request->message; ?>
            <?php
            $html_message = ob_get_clean();
            $newMessage = $this->inbox->newQuery()->create([
                "subject" => "RE: ".$message->subject,
                "message" => $html_message,
                "from_id" => auth()->user()->id,
                "to_id" => $message->from_id
            ]);

            try {
                $newMessage->to->notify(new NewMessageFrom($newMessage));
            }catch (\Exception $exception) {
                Log::error($exception->getMessage());
                return redirect()->back();
            }

            toastr()->success('La réponse du message à été envoyer');
            return redirect()->back();
        }catch (\Exception $exception) {
            Log::error($exception->getMessage());
            toastr()->error("Erreur lors de l'envoie de votre réponse !");
            return redirect()->back();
        }
    }

    public function delete($messagerie_id)
    {
        $this->inbox->newQuery()->find($messagerie_id)->delete();

        LogActivity::addToLog("Suppression du message ".$messagerie_id);

        return response()->json();
    }
}
