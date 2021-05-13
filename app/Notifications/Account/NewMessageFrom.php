<?php

namespace App\Notifications\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;
use NotificationChannels\OneSignal\OneSignalWebButton;

class NewMessageFrom extends Notification
{
    use Queueable;

    private $inbox;

    /**
     * Create a new notification instance.
     *
     * @param $inbox
     */
    public function __construct($inbox)
    {
        $this->inbox = $inbox;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', OneSignalChannel::class];
    }

    public function toOneSignal($notifiable)
    {
        return OneSignalMessage::create()
            ->setSubject("TPFF - Un nouveau message est disponible")
            ->setBody("De la part de {$this->inbox->from->name}")
            ->setUrl(route('account.messagerie.view', $this->inbox->id))
            ->setWebButton(
                OneSignalWebButton::create('Voir le message')
                    ->icon(storage_path('files/shares/core/logo_carre_couleur.png'))
                    ->url(route('account.messagerie.view', $this->inbox->id))
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "title" => "Nouveau message disponible",
            "desc" => "{$this->inbox->subject}",
            "icon" => "envelope",
            "link" => route('account.messagerie.view', $this->inbox->id)
        ];
    }
}
