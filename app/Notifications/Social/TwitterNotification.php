<?php

namespace App\Notifications\Social;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twitter\Exceptions\CouldNotSendNotification;
use NotificationChannels\Twitter\TwitterChannel;
use NotificationChannels\Twitter\TwitterStatusUpdate;

class TwitterNotification extends Notification
{
    use Queueable;

    public $title;
    public $body;
    public $imageFile;

    /**
     * Create a new notification instance.
     *
     * @param $title
     * @param $body
     * @param $imageFile
     */
    public function __construct($title, $body, $imageFile = null)
    {
        //
        $this->title = $title;
        $this->body = $body;
        $this->imageFile = $imageFile;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TwitterChannel::class];
    }

    public function toTwitter($notifiable)
    {
        if($this->imageFile != null) {
            try {
                return (new TwitterStatusUpdate($this->body))->withImage($this->imageFile);
            } catch (CouldNotSendNotification $e) {
                return $e;
            }
        } else {
            try {
                return new TwitterStatusUpdate($this->body);
            } catch (CouldNotSendNotification $e) {
                return $e;
            }
        }
    }
}
