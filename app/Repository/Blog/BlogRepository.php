<?php


namespace App\Repository\Blog;


use App\Models\Blog\Blog;

class BlogRepository
{
    public function getActiveOrderBuDate($nbrPages = 3)
    {
        return $this->queryActiveOrderByDate()->paginate($nbrPages);
    }

    public function getHeros()
    {
        return $this->queryActive()
            ->with('categories')
            ->latest('updated_at')
            ->take(5)
            ->get();
    }

    public function getPostBySlug($slug)
    {
        $post = Blog::with(
            'tags:id,tag,slug'
        )
            ->withCount('validComments')
            ->whereSlug($slug)
            ->firstOrFail();

        $post->previous = $this->getPreviousPost($post->id);
        $post->next = $this->getNextPost($post->id);

        return $post;
    }

    public function getActiveOrderByDateForCategory($nbrPages, $category_slug)
    {
        return $this->queryActiveOrderByDate()
            ->whereHas('categories', function ($q) use ($category_slug) {
                $q->where('blog_categories.slug', $category_slug);
            })->paginate($nbrPages);
    }

    public function searchBlog($n, $search)
    {
        return $this->queryActiveOrderByDate()
            ->where(function ($q) use ($search) {
                $q->where('short_content', 'like', "%$search%")
                    ->orWhere('content', 'like', "%$search%")
                    ->orWhere('title', 'like', "%$search%");
            })
            ->paginate($n);
    }

    protected function queryActive()
    {
        return Blog::select('id', 'slug', 'image', 'title', 'short_content', 'created_at', 'updated_at')
            ->whereActive(true);
    }

    protected function queryActiveOrderByDate()
    {
        return $this->queryActive()->latest();
    }

    protected function getPreviousPost($id)
    {
        return Blog::select('title', 'slug')
            ->whereActive(true)
            ->latest('id')
            ->firstWhere('id', '<', $id);
    }

    protected function getNextPost($id)
    {
        return Blog::select('title', 'slug')
            ->whereActive(true)
            ->oldest('id')
            ->firstWhere('id', '>', $id);
    }
}
