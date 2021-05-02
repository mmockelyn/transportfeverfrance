<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogCategory;
use App\Repository\Blog\BlogRepository;
use App\Repository\Download\DownloadRepository;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * @var BlogRepository
     */
    protected $blogRepository;
    /**
     * @var Repository|Application|mixed
     */
    protected $nbrPages;
    /**
     * @var DownloadRepository
     */
    private $downloadRepository;

    /**
     * BlogController constructor.
     * @param BlogRepository $blogRepository
     * @param DownloadRepository $downloadRepository
     */
    public function __construct(BlogRepository $blogRepository, DownloadRepository $downloadRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->nbrPages = config('app.nbrpages.blogs');
        $this->downloadRepository = $downloadRepository;
    }

    public function index()
    {
        $blogs = $this->blogRepository->getActiveOrderBuDate();
        $downloads = $this->downloadRepository->getActiveOrderBuDate();
        $heros = $this->blogRepository->getHeros();

        //dd($downloads);


        return view('front.index', compact('blogs', 'heros', 'downloads'));
    }

    public function list()
    {
        $blogs = $this->blogRepository->getActiveOrderBuDate($this->nbrPages);

        return view('front.blog.index', compact('blogs'));
    }

    public function category(BlogCategory $category)
    {
        $blogs = $this->blogRepository->getActiveOrderByDateForCategory($this->nbrPages, $category->slug);
        $title = 'Article de la catégorie: <strong>'.$category->title.'</strong>';

        return view('front.blog.category', compact('blogs', 'title'));
    }

    public function show(Request $request, $slug)
    {
        $blog = $this->blogRepository->getPostBySlug($slug);

        return view('front.blog.show', compact('blog'));
    }
}
