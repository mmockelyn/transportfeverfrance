<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AgeUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User
     */
    public User $user;
    /**
     * @var integer
     */
    public int $age;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param $age
     */
    public function __construct(User $user, $age)
    {
        //
        $this->user = $user;
        $this->age = $age;
    }
}
