<?php

namespace App\Models\Blog;

use App\Events\ModelCreated;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kalnoy\Nestedset\NodeTrait;

class BlogComment extends Model
{
    use HasFactory, NodeTrait, Notifiable;

    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    protected $fillable = ['content', 'blog_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
