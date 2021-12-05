<?php

namespace App\Http\Controllers\Back\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Blog\CreateBlogRequest;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogComment;
use App\Models\Blog\BlogStat;
use App\Models\Blog\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class BlogController extends Controller
{
    public function dashboard()
    {
        return view('back.blog.dashboard', [
            "blogs" => Blog::all()
        ]);
    }

    public function create()
    {
        return view('back.blog.create', [
            "categories" => BlogCategory::all()
        ]);
    }

    public function store(CreateBlogRequest $request)
    {

        //dd($request->all());
        try {
            $article = Blog::create([
                "title" => $request->title,
                "slug" => Str::slug($request->title),
                "seo_title" => $request->title,
                "short_content" => $request->short_content,
                "content" => $request->contents,
                "meta_description" => Str::limit($request->contents, 255, ''),
                "meta_keywords" => null,
                "active" => 0,
                "image" => null
            ]);

            // Register Category

            foreach ($request->category as $category) {
                $article->categories()->attach($category);
            }

            // register tags

            $article->update(["meta_keywords" => $request->meta_keywords]);

            if($request->has('image')) {
                try {
                    $request->image->storeAs('files/shares/blog', $article->id . '.' . $request->image->extension(), 'public');

                    try {
                        $article->update([
                            "image" => $article->id . '.' . $request->image->extension()
                        ]);

                        toastr()->success("L'article <strong></strong> à été créer avec succès !", "Création d'un article");
                        return redirect()->route('back.blog.dashboard');

                    } catch (\Exception $exception) {
                        dd($exception);
                    }
                } catch (FileException $exception) {
                    dd($exception->getMessage());
                }
            }

            toastr()->success("L'article <strong></strong> à été créer avec succès !", "Création d'un article");
            return redirect()->route('back.blog.dashboard');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $actualYear = $request->year;

        if (BlogStat::oldest()->first()) {
            $year = range(BlogStat::oldest()->first()->created_at->year, now()->year);

            return view('back.blog.show', [
                "blog" => Blog::find($id),
                "years" => $year,
                "actualYear" => $actualYear,
                "comments" => BlogComment::where('blog_id', $id)->limit(5)->get()
            ]);
        } else {
            return view('back.blog.show', [
                "blog" => Blog::find($id),
                "actualYear" => $actualYear,
                "comments" => BlogComment::where('blog_id', $id)->limit(5)->get()
            ]);
        }
    }

    public function edit($id)
    {
        return view('back.blog.edit', [
            "blog" => Blog::find($id),
            "categories" => BlogCategory::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            Blog::find($id)->update([
                "title" => $request->title,
                "slug" => Str::slug($request->title),
                "seo_title" => $request->title,
                "short_content" => $request->short_content,
                "content" => $request->contents,
                "meta_description" => Str::limit($request->contents, 255, ''),
                "meta_keywords" => null,
                "active" => 0,
                "image" => null
            ]);

            $article = Blog::find($id);

            $article->update(["meta_keywords" => $request->meta_keywords]);

            if($request->has('image')) {
                try {
                    $request->image->storeAs('files/shares/blog', $article->id . '.' . $request->image->extension(), 'public');

                    try {
                        $article->update([
                            "image" => $article->id . '.' . $request->image->extension()
                        ]);

                        toastr()->success("L'article <strong>$article->title</strong> à été editer avec succès !", "Edition d'un article");
                        return redirect()->route('back.blog.edit', $id);

                    } catch (\Exception $exception) {
                        dd($exception);
                    }
                } catch (FileException $exception) {
                    dd($exception->getMessage());
                }
            }

            toastr()->success("L'article <strong>$article->title</strong> à été editer avec succès !", "Edition d'un article");
            return redirect()->route('back.blog.edit', $id);
        }catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function comments($id)
    {
        return view("back.blog.comments", [
            "blog" => Blog::find($id),
            "comments" => Blog::find($id)->validComments()
                ->withDepth()
                ->latest()
                ->get()
                ->toTree()
        ]);
    }
}
