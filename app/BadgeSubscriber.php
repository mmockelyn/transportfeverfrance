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
    }

    public function notifyBadgeUnlock($user, $badge)
    {
        if($badge) {
            $user->notify(new BadgeUnlocked($badge));
        }
    }

    public function onNewComment($comment)
    {
        $user = $comment->user;
        $comments_count = $user->blogcomments()->count();
        $badge = $this->badge->unlockActionFor($user, 'comments', $comments_count);
        $this->notifyBadgeUnlock($user, $badge);
    }
}
