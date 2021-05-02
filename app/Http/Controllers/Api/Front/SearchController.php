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

        ob_start();
        ?>
        <div class="quick-search-result">
            <?php if($cb == 0 && $cd == 0): ?>
                <div class="text-muted d-none">
                    Aucun résultat pour la recherche: <strong><?= $search; ?></strong>
                </div>
            <?php else: ?>
                <div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                    Articles du blog: <strong><?= $search; ?></strong>
                </div>
                <div class="mb-10">
                    <?php foreach ($blogs as $blog): ?>
                        <div class="d-flex align-items-center flex-grow-1 mb-2">
                            <div class="symbol symbol-30 bg-transparent flex-shrink-0">
                                <img src="/storage/files/shares/slider/<?= $blog->image; ?>" alt="<?= $blog->title; ?>"/>
                            </div>
                            <div class="d-flex flex-column ml-3 mt-2 mb-2">
                                <a href="<?= route('front.blog.show', $blog->slug) ?>" class="font-weight-bold text-dark text-hover-primary">
                                    <?= $blog->title; ?>
                                </a>
                                <span class="font-size-sm font-weight-bold text-muted">
                                    le <?= formatDateHour($blog->updated_at) ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                    Articles en téléchargement: <strong><?= $search; ?></strong>
                </div>
                <div class="mb-10">
                    <?php foreach ($downloads as $download): ?>
                        <div class="d-flex align-items-center flex-grow-1 mb-2">
                            <div class="symbol symbol-30 bg-transparent flex-shrink-0">
                                <img src="/storage/files/shares/download/<?= $download->image; ?>" alt="<?= $download->title; ?>"/>
                            </div>
                            <div class="d-flex flex-column ml-3 mt-2 mb-2">
                                <a href="<?= route('front.download.show', $download->slug) ?>" class="font-weight-bold text-dark text-hover-primary">
                                    <?= $download->title; ?>
                                </a>
                                <span class="font-size-sm font-weight-bold text-muted">
                                    le <?= formatDateHour($download->updated_at) ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }

    public function search_download(Request $request, $subcategory_id)
    {
        $search = $request->search;
        $downloads = $this->downloadRepository->searchDownload($search, $subcategory_id);

        $c = count($downloads);
        ob_start();
        ?>
        <?php foreach ($downloads as $download): ?>
        <div class="col-4">
            <div class="card card-custom gutter-b card-stretch">
                <!--begin::Body-->
                <div class="card-body pt-4">
                    <!--begin::User-->
                    <div class="d-flex align-items-center mb-7">
                        <!--begin::Pic-->
                        <div class="flex-shrink-0 mr-4">
                            <div class="symbol symbol-circle symbol-lg-75">
                                <img src="storage/files/shares/download/<?= $download->image; ?>" alt="image">
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column">
                            <a href="<?= route('front.download.show', $download->slug); ?>>" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0"><?= $download->title; ?></a>
                            <?php if($download->provider == 'steam'): ?>
                            <span class="label label-lg label-inline font-weight-bold label-rounded">
                                            <span class="symbol symbol-20 mr-3">
                                                <img alt="Pic" src="storage/files/shares/core/icons/steam_icon.png"/>
                                            </span> Steam
                                        </span>
                            <?php endif; ?>
                            <?php if($download->provider == 'tfnet'): ?>
                            <span class="label label-lg label-inline font-weight-bold label-rounded">
                                            <span class="symbol symbol-20 mr-3">
                                                <img alt="Pic" src="storage/files/shares/core/icons/tf_net_icon.png"/>
                                            </span> Transport Fever.net
                                        </span>
                            <?php endif; ?>
                            <?php if($download->provider == 'tf_france'): ?>
                            <span class="label label-lg label-inline font-weight-bold label-rounded">
                                            <span class="symbol symbol-20 mr-3">
                                                <img alt="Pic" src="storage/files/shares/core/icons/tf_france_icon.png"/>
                                            </span> Transport Fever France
                                        </span>
                            <?php endif; ?>
                            <?php if($download->provider == 'null'): ?>
                            <span class="label label-lg label-inline font-weight-bold label-rounded">
                                            <span class="symbol symbol-20 mr-3">
                                                <img alt="Pic" src="storage/files/shares/core/icons/null_icon.png"/>
                                            </span> Interieur
                                        </span>
                            <?php endif; ?>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::User-->
                    <!--begin::Desc-->
                    <p class="mb-7"><?= $download->short_content; ?></p>
                    <!--end::Desc-->
                    <!--begin::Info-->
                    <div class="mb-7">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-dark-75 font-weight-bolder mr-2">Version:</span>
                            <a href="#" class="text-muted text-hover-primary"><?= $download->version_latest; ?></a>
                        </div>
                        <div class="d-flex justify-content-between align-items-cente my-1">
                            <span class="text-dark-75 font-weight-bolder mr-2">Mise à jours:</span>
                            <a href="#" class="text-muted text-hover-primary"><?= formatDate($download->updated_at); ?></a>
                        </div>
                    </div>
                    <!--end::Info-->
                    <a href="<?= route('front.download.show', $download->slug); ?>>" class="btn btn-block btn-sm btn-light-success font-weight-bolder text-uppercase py-4">Voir le package</a>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <?php endforeach; ?>
        <?php
        $html = ob_get_clean();

        return response()->json([
            'html' => $html,
            'count' => $c,
            'terme' => $search
        ]);
    }
}
