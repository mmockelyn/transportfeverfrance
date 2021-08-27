<?php

namespace App\Http\Controllers\Api\Back\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function delete(Blog $blog)
    {
        Blog::findOrFail($blog)->delete();

        return response()->json();
    }
}
