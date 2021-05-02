<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\BlogCommentRequest;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function __construct()
    {
        if(!app()->runningInConsole() && !\request()->ajax()) {
            abort(403);
        }
    }

    public function store(BlogCommentRequest $request, Blog $blog)
    {
        $data = [
            'body' => $request->message,
            'blog_id' => $blog->id,
            'user_id' => $request->user()->id,
        ];

        $request->has('commentId') ?
            BlogComment::findOrFail($request->commentId)->children()
            ->create($data) :
            BlogComment::create($data);

        $commenter = $request->user();

        return response()->json($commenter->valid ? 'ok' : 'invalid');
    }

    public function destroy(BlogComment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return response()->json();
    }

    public function comments(Blog $blog)
    {
        $comments = $blog->validComments()
            ->withDepth()
            ->latest()
            ->get()
            ->toTree();

        $blog = $blog->findOrFail($blog->id);

        return [
            'html' => view('front.blog.comments', compact('comments', 'blog'))->render(),
        ];
    }
}
