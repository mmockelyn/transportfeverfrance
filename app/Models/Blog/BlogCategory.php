<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }
}
