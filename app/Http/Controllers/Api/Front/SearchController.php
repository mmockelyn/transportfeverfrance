<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\SearchRequest;
use App\Repository\Blog\BlogRepository;
use App\Repository\Download\DownloadRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @var BlogRepository
     */
    protected $blogRepository;
    /**
     * @var DownloadRepository
     */
    private $downloadRepository;

    /**
     * SearchController constructor.
     * @param BlogRepository $blogRepository
     * @param DownloadRepository $downloadRepository
     */
    public function __construct(BlogRepository $blogRepository, DownloadRepository $downloadRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->downloadRepository = $downloadRepository;
    }

    public function search(SearchRequest $request)
    {
        $search = $request->search;
        $blogs = $this->blogRepository->searchBlog(6, $search);
        $downloads = $this->downloadRepository->search(6, $search);

        $cb = count($blogs);
        $cd = count($downloads);

        return view('new_front.search', [
            'search' => $search,
            'blogs' => $blogs,
            'downloads' => $downloads,
            'count_blog' => $cb,
            'count_download' => $cd,
            'count' => $cb + $cd
        ]);
    }

    public function search_download(Request $request, $subcategory_id)
    {
        $search = $request->search;
        $downloads = $this->downloadRepository->searchDownload($search, $subcategory_id);

        $c = count($downloads);


        return response()->json([
            'downloads' => $downloads,
            'count' => $c,
            'terme' => $search
        ]);
    }
}
