<?php

namespace App\Notifications;

use App\Models\Core\Badge;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class BadgeUnlocked extends Notification
{
    use Queueable;

    /**
     * @var Badge
     */
    private $badge;

    /**
     * Create a new notification instance.
     *
     * @param Badge $badge
     */
    public function __construct(Badge $badge)
    {
        $this->badge = $badge;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', DiscordChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Nouveau Badge débloqué")
            ->line("Vous avez débloqué le badge " . $this->badge->name)
            ->line('Bravo !');
    }

    public function toDiscord($notifiable)
    {
        return DiscordMessage::create("Felicitation !!!, Vous avez débloquer le badge {$this->badge->name} sur le site de TPF France", [
            "image" => [
                "url" => env('APP_URL')."/storage/files/shares/badges/{$this->badge->action}".($this->badge->action_count != 0) ? "-".$this->badge->action_count : null.".png"
            ]
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'name' => $this->badge->name
        ];
    }

    public static function toText($data)
    {
        return "Vous avez débloqué le badge " . $data['name'];
    }
}
