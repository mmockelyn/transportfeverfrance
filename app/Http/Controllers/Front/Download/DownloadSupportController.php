<?php

namespace App\Http\Controllers\Front\Download;

use App\Http\Controllers\Controller;
use App\Mail\Front\Download\Support\NewTicketOutUser;
use App\Models\Download\DownloadSupport;
use App\Models\Download\DownloadSupportRoom;
use App\Notifications\Download\DownloadSupportForAuthorNotification;
use App\Repository\Download\DownloadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class DownloadSupportController extends Controller
{
    /**
     * @var DownloadSupport
     */
    private $downloadSupport;
    /**
     * @var DownloadRepository
     */
    private $downloadRepository;

    /**
     * DownloadSupportController constructor.
     * @param DownloadSupport $downloadSupport
     * @param DownloadRepository $downloadRepository
     */
    public function __construct(DownloadSupport $downloadSupport, DownloadRepository $downloadRepository)
    {
        $this->downloadSupport = $downloadSupport;
        $this->downloadRepository = $downloadRepository;
        Carbon::setLocale('fr');
    }

    public function newSupport(Request $request, $slug)
    {
        //dd($request->all());
        $download = $this->downloadRepository->getPostBySlug($slug);
        if($request->has('user_id')) {
            $data = [
                "user_id" => $request->user_id,
                "subject" => $request->subject,
                "message" => $request->message,
                "download_id" => $download->id
            ];
            $ticket = $this->downloadSupport->newQuery()->create($data);
            DownloadSupportRoom::create([
                'message' => $request->message,
                'user_id' => $request->user_id,
                'download_support_id' => $ticket->id
            ]);
            foreach ($download->users as $user) {
                if($user->social !== null && $user->social->discord_user_id !== null) {
                    $user->notify(new DownloadSupportForAuthorNotification($ticket));
                }
            }

            return response()->json([
                "ticket_id" => $ticket->id,
                "message" => "Votre demande à bien été soumise aux auteurs du mod."
            ]);
        } else {
            $data = [
                "name_user" => $request->name,
                "email_user" => $request->email,
                "subject" => $request->subject,
                "message" => $request->message,
                "download_id" => $download->id
            ];
            $ticket = $this->downloadSupport->newQuery()->create($data);
            DownloadSupportRoom::create([
                'message' => $request->message,
                'user_id' => 1,
                'download_support_id' => $ticket->id
            ]);
            $tick = $this->downloadSupport->newQuery()->find($ticket->id);
            foreach ($download->users as $user) {
                if($user->social !== null && $user->social->discord_user_id !== null) {
                    $user->notify(new DownloadSupportForAuthorNotification($ticket));
                }
            }
            Mail::to($request->email)->send(new NewTicketOutUser($tick));
            return response()->json([
                "ticket_id" => $ticket->id,
                "message" => "Votre demande à bien été soumise aux auteurs du mod. Par ailleurs, vous n'avez pas de compte, un Email vous à été envoyer afin de suivre l'avancer de votre requete."
            ]);
        }
    }

    public function show($slug, $room)
    {
        $ticket = $this->downloadSupport->newQuery()->find($room);

        return view('front.download.room', compact('ticket'));
    }
}
