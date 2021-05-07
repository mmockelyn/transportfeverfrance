<?php

namespace App\Models\Core;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadgeUnlock extends Model
{
    use HasFactory;
    protected $table = 'badge_user';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
