<?php

namespace App\Notifications\Back\Setting\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserWithoutPassword extends Notification
{
    use Queueable;

    public $user;
    public $password;

    /**
     * Create a new notification instance.
     *
     * @param $user
     * @param $password
     */
    public function __construct($user, $password)
    {
        //
        $this->user = $user;
        $this->password = $password;
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
            ->subject("Bonjour ".$this->user->name)
            ->line("Votre compte à été créer par un administrateur de ".env("APP_NAME").".<br>Par default et à des fins de protection, le mot de passe a été générer aléatoirement:")
            ->line("Votre mot de passe: <strong>".$this->password."</strong>")
            ->line("Veillez à changer ce mot de passe à des fin de sécurité par l'intermédiaire <strong>Mon Profil -> onglet \"Sécutité\" -> Changer mon mot de passe</strong>.")
            ->action('Acceder à mon profil', route('account.profil'));
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
            'title' => "Nouvelle utilisateur",
            'desc' => "L'utilisateur <strong>".$this->user->name."</strong> à été ajouter manuellement !",
            'icon' => 'user',
            'link' => '/'
        ];
    }
}
