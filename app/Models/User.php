<?php

namespace App\Models;

use App\Events\ModelCreated;
use App\Models\Blog\BlogComment;
use App\Models\Download\Download;
use App\Models\Download\DownloadComment;
use App\Models\Download\DownloadSupport;
use App\Models\Download\DownloadSupportRoom;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ["created_at", "updated_at", "last_seen"];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function social()
    {
        return $this->hasOne(UserSocial::class);
    }

    public function blogcomments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function downloadcomments()
    {
        return $this->hasMany(DownloadComment::class);
    }

    public function downloadsupports()
    {
        return $this->hasMany(DownloadSupport::class);
    }

    public function downloads()
    {
        return $this->belongsToMany(Download::class);
    }

    public function isAdmin()
    {
        return $this->group === 1;
    }

    public function rooms()
    {
        return $this->hasMany(DownloadSupportRoom::class);
    }

    public function tutorials()
    {
        return $this->hasMany(UserTutorial::class);
    }

    public function routeNotificationForDiscord()
    {
        return $this->discord_channel;
    }
}
