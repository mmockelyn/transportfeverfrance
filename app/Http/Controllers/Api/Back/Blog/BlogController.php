<?php

namespace App\Http\Controllers\Api\Back\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogComment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function delete($id, $comment_id)
    {
        try {
            $comments = BlogComment::where("id", $comment_id);

            $comments->delete();

            return response()->json();
        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
}
