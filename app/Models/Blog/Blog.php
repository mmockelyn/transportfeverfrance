<?php

namespace App\Models\Blog;

use App\Events\ModelCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Blog extends Model
{
    use HasFactory, Notifiable;

    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    protected $fillable = [
        'title', 'slug', 'seo_title', 'short_content', 'content',
        'meta_description', 'meta_keywords', 'active', 'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class);
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function validComments()
    {
        return $this->comments()->whereHas('user', function ($query) {
            $query->whereValid(true);
        });
    }
}
