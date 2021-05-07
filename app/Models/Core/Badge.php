<?php

namespace App\Models\Core;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function unlocks()
    {
        return $this->hasMany(BadgeUnlock::class);
    }

    public function isUnlockedFor(User $user): bool
    {
        return $this->unlocks()
            ->where('user_id', $user->id)
            ->exists();
    }

    public function unlockActionFor(User $user, string $action, int $count = 0)
    {
        $badge = $this->newQuery()
            ->where('action', $action)
            ->where('action_count', $count)
            ->first();

        if ($badge && !$badge->isUnlockedFor($user)) {
            $user->badges()->attach($badge);
            return $badge;
        }

        return null;
    }
}
