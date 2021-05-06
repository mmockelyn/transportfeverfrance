<?php

namespace Tests\Feature\Blog;

use App\Models\Blog\BlogCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_category_blog()
    {
        $category = BlogCategory::create([
            "title" => "lorem ipsum",
            "slug" => "lorem-ipsum"
        ]);

        $this->assertDatabaseCount('blog_categories', 1);
    }
}
