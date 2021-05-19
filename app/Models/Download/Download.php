<?php

namespace App\Models\Download;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Download extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(DownloadCategory::class, 'download_category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(DownloadSubCategory::class, 'download_sub_category_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function comments()
    {
        return $this->hasMany(DownloadComment::class);
    }

    public function versions()
    {
        return $this->hasMany(DownloadVersion::class);
    }

    public function supports()
    {
        return $this->hasMany(DownloadSupport::class);
    }

    public function wiki()
    {
        return $this->hasOne(DownloadWiki::class);
    }

    public function feature()
    {
        return $this->hasOne(DownloadFeature::class);
    }

    public function validComments()
    {
        return $this->comments()->whereHas('user', function ($query) {
            $query->whereValid(true);
        });
    }
}
