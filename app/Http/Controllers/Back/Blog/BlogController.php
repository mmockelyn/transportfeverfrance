<?php

namespace App\Http\Controllers\Back\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function dashboard()
    {
        return view('back.blog.dashboard', [
            "blogs" => Blog::all()
        ]);
    }
}
