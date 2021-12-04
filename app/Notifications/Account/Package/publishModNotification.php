<?php

namespace App\Notifications\Account\Package;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class publishModNotification extends Notification
{
    use Queueable;

    private $download;

    /**
     * Create a new notification instance.
     *
     * @param $download
     */
    public function __construct($download)
    {
        //
        $this->download = $download;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'mail',
            'database',
            WebPushChannel::class,
            ];
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
            ->subject('Un nouveau mod à été publier sur Transport Fever France')
            ->greeting("Un nouveau mod à été publier")
            ->line("Le mod <strong></strong> à été publier sur le site ".config('app.name'))
            ->action('Voir le mod', route('front.download.show', $this->download->slug))
            ->line("N'hésitez pas à poster vos retours sur le discord de TPFF");
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
            "title" => "Nouveau mod disponible",
            "desc" => "Le mod <strong>{$this->download->title}</strong> à été publier",
            "icon" => "box-open",
            "link" => route('front.download.show', $this->download->slug)
        ];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage())
            ->title($this->download->title." Publier !")
            ->icon('/account/assets/media/icons/duotune/general/gen048.svg')
            ->body("Le mod <strong>".$this->download->title."</strong> à été publier !")
            ->action('Voir le mod', route('front.download.show', $this->download->slug))
            ->options(['TTL' => 1000]);
    }
}
