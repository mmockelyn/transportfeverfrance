<?php

namespace App\Http\Controllers\Api\Back;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use Illuminate\Http\Request;

class BackController extends Controller
{
    public function publishing(Request $request)
    {
        //dd($request->all());

        switch ($request->provider) {
            case 'blog':
                return $this->publishBlog($request->providerId);
                break;
        }
    }

    public function unpublishing(Request $request)
    {
        switch ($request->provider) {
            case 'blog':
                return $this->unpublishBlog($request->providerId);
                break;
        }
    }

    private function publishBlog($id)
    {
        try {
            Blog::find($id)->update([
                "active" => true,
                "updated_at" => now()
            ]);

            return Blog::find($id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    private function unpublishBlog($id)
    {
        try {
            Blog::find($id)->update([
                "active" => false,
                "updated_at" => now()
            ]);

            return Blog::find($id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

}
