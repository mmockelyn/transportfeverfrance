<?php

namespace App\Notifications\Back\Setting\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserDeleted extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @param $user
     */
    public function __construct($user)
    {
        //
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("Votre compte à été supprimer")
                    ->greeting("Bonjour $this->user->name")
            ->line("Votre compte à été supprimer par un administrateur à ce jours ".now()->format('d/m/Y H:i'))
            ->error();
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
            'title' => "Suppression utilisateur",
            'desc' => "L'utilisateur <strong>".$this->user->name."</strong> à été supprimer manuellement !",
            'icon' => 'user',
            'link' => '/backoffice'
        ];
    }
}
