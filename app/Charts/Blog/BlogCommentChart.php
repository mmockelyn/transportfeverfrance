<?php

declare(strict_types = 1);

namespace App\Charts\Blog;

use App\Charts\CommonChart;
use App\Models\Blog\BlogComment;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class BlogCommentChart extends CommonChart
{
    public ?string $name = 'blog_comment_chart';
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        return $this->chartisan(new BlogComment, 'Commentaires');
    }
}
