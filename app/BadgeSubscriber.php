<?php


namespace App;


use App\Models\Core\Badge;
use App\Notifications\BadgeUnlocked;

class BadgeSubscriber
{
    /**
     * @var Badge
     */
    private $badge;

    /**
     * BadgeSubscriber constructor.
     * @param Badge $badge
     */
    public function __construct(Badge $badge)
    {
        $this->badge = $badge;
    }

    public function subscribe($events)
    {
        $events->listen('eloquent.saved: App\Model\BlogComment', [$this, 'onNewComment']);
        $events->listen('App\Events\newUser', [$this, 'onNewUser']);
        $events->listen('App\Events\searchTffrance', [$this, 'onTrain']);
        $events->listen('App\Events\AgeUser', [$this, 'onAge']);
    }

    public function notifyBadgeUnlock($user, $badge)
    {
        if ($badge) {
            $user->notify(new BadgeUnlocked($badge));
        }
    }

    public function onAge($event)
    {
        $badge = $this->badge->unlockActionFor($event->user, 'ages', $event->age);
        $this->notifyBadgeUnlock($event->user, $badge);
    }

    public function onTrain($event)
    {
        $badge = $this->badge->unlockActionFor($event->user, 'train');
        $this->notifyBadgeUnlock($event->user, $badge);
    }

    public function onNewUser($event)
    {
        $badge = $this->badge->unlockActionFor($event->user, 'newuser');
        $this->notifyBadgeUnlock($event->user, $badge);
    }

    public function onNewComment($comment)
    {
        $user = $comment->user;
        $comments_count = $user->blogcomments()->count() + $user->downloadcomments()->count();
        $badge = $this->badge->unlockActionFor($user, 'comments', $comments_count);
        $this->notifyBadgeUnlock($user, $badge);
    }
}
