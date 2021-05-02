<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    protected $fillable = ['tag'];
    public $timestamps = false;

    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }
}
