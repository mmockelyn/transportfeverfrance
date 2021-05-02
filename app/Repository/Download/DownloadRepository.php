<?php


namespace App\Repository\Download;

use App\Models\Blog\Blog;
use App\Models\Download\Download;
use App\Models\Download\DownloadCommentReport;

class DownloadRepository
{
    /**
     * @var DownloadCommentReport
     */
    private $downloadCommentReport;

    /**
     * DownloadRepository constructor.
     * @param DownloadCommentReport $downloadCommentReport
     */
    public function __construct(DownloadCommentReport $downloadCommentReport)
    {
        $this->downloadCommentReport = $downloadCommentReport;
    }

    public function getActiveOrderBuDate($nbrPages = 3)
    {
        return $this->queryActiveOrderByDate()->paginate($nbrPages);
    }

    public function getActiveOrderByDateForCategory($nbrPages, $subcategory_id)
    {
        return Download::where('download_sub_category_id', $subcategory_id)
            ->paginate($nbrPages);
    }

    public function getPostBySlug($slug)
    {
        $post = Download::whereSlug($slug)
            ->firstOrFail();

        $post->previous = $this->getPreviousPost($post->id);
        $post->next = $this->getNextPost($post->id);

        return $post;
    }

    public function searchDownload($search, $subcategory_id, $n = null)
    {
        if($n !== null) {
            return Download::where('download_sub_category_id', $subcategory_id)
                ->where(function ($q) use ($search) {
                    $q->where('short_content', 'like', "%$search%")
                        ->orWhere('content', 'like', "%$search%")
                        ->orWhere('title', 'like', "%$search%");
                })
                ->paginate($n);
        } else {
            return Download::where('download_sub_category_id', $subcategory_id)
                ->where(function ($q) use ($search) {
                    $q->where('short_content', 'like', "%$search%")
                        ->orWhere('content', 'like', "%$search%")
                        ->orWhere('title', 'like', "%$search%");
                })
                ->get();
        }
    }

    public function reportComment($comment_id, $user_id)
    {
        return $this->downloadCommentReport->newQuery()->create([
            'download_comment_id' => $comment_id,
            'user_id' => $user_id
        ]);
    }

    public function search($int, $search)
    {
        return $this->queryActiveOrderByDate()
            ->where(function ($q) use ($search) {
                $q->where('short_content', 'like', "%$search%")
                    ->orWhere('content', 'like', "%$search%")
                    ->orWhere('title', 'like', "%$search%");
            })
            ->paginate($int);
    }


    protected function queryActive()
    {
        return Download::with('subcategory', 'category')->whereActive(true);
    }

    protected function queryActiveOrderByDate()
    {
        return $this->queryActive()->latest();
    }

    protected function getPreviousPost($id)
    {
        return Download::select('title', 'slug')
            ->whereActive(true)
            ->latest('id')
            ->firstWhere('id', '<', $id);
    }

    protected function getNextPost($id)
    {
        return Download::select('title', 'slug')
            ->whereActive(true)
            ->oldest('id')
            ->firstWhere('id', '>', $id);
    }


}
