<?php

namespace App\Http\Controllers\Front\Download;

use App\Helpers\Format;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Download\DownloadCommentRequest;
use App\Models\Download\Download;
use App\Models\Download\DownloadCategory;
use App\Models\Download\DownloadComment;
use App\Models\Download\DownloadCommentReport;
use App\Models\Download\DownloadSubCategory;
use App\Repository\Download\DownloadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Syntax\SteamApi\Facades\SteamApi;


class DownloadController extends Controller
{
    /**
     * @var DownloadRepository
     */
    private $downloadRepository;

    /**
     * DownloadController constructor.
     * @param DownloadRepository $downloadRepository
     */
    public function __construct(DownloadRepository $downloadRepository)
    {
        $this->downloadRepository = $downloadRepository;
        Carbon::setLocale('fr');
    }

    public function category($subCategory_id)
    {
        $downloads = $this->downloadRepository->getActiveOrderByDateForCategory(10, $subCategory_id);
        $sub = DownloadSubCategory::findOrFail($subCategory_id);

        return view('new_front.download.category', compact('downloads', 'sub'));
    }

    public function home($category_id)
    {
        $category = DownloadCategory::query()->find($category_id);
        $downloads = Download::query()->where('download_category_id', $category_id)->get();

        return view('new_front.download.home', compact('downloads', 'category'));
    }

    public function show(Request $request, $slug)
    {
        \Carbon\Carbon::setLocale('fr');
        $download = $this->downloadRepository->getPostBySlug($slug);
        $d = Download::query()->where('slug', $slug)->first();
        try {
            $d->update([
                "count_view" => $download->count_view +1
            ]);
        }catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }

        //dd(auth()->user()->downloadsupports);

        return view('new_front.download.show', compact('download'));
    }

    public function storeComment(DownloadCommentRequest $request, $slug)
    {
        $download = $this->downloadRepository->getPostBySlug($slug);
        $data = [
            'content' => $request->message,
            'download_id' => $download->id,
            'user_id' => $request->user_id
        ];

        try {
            DownloadComment::create($data);
            return response()->json('ok');
        } catch (\Exception $exception) {
            return response()->json('invalid');
        }
    }

    public function replyComment(Request $request, $slug)
    {
        $download = $this->downloadRepository->getPostBySlug($slug);
        $data = [
            'content' => '<a href="'.url()->previous().'#comment-'.$request->comment_id.'"><p><i>'.$request->prevMessage.'</i></p></a><p>'.$request->message.'</p>',
            'download_id' => $download->id,
            'user_id' => $request->user_id
        ];

        DownloadComment::create($data);

        return response()->json('ok');
    }

    public function reportComment($slug, $comment_id)
    {
        $data = [
            'download_comment_id' => $comment_id,
            'user_id' => auth()->user()->id
        ];

        try {
            $this->downloadRepository->reportComment($comment_id, auth()->user()->id);
            return true;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function deleteComment($slug, $comment_id)
    {
        try {
            DownloadComment::findOrFail($comment_id)->delete();
            return response()->json();
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
