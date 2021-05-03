<?php

namespace Database\Seeders;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use App\Models\Contact;
use App\Models\Download\Download;
use App\Models\Download\DownloadCategory;
use App\Models\Download\DownloadComment;
use App\Models\Download\DownloadSubCategory;
use App\Models\Download\DownloadSupport;
use App\Models\Download\DownloadVersion;
use App\Models\Download\DownloadWiki;
use App\Models\Page;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::withoutEvents(function () {
            User::create([
                'name' => "Bot TF France",
                'email' => "bot@transportfeverfrance.fr",
                'password' => bcrypt('0000'),
                'group' => 0,
                'avatar' => null,
            ]);
        });

        $nbUsers = 1;


        DB::table('blog_categories')->insert([
            [
                'title' => "Category 1",
                'slug' => 'category-1'
            ],
            [
                'title' => "Category 2",
                'slug' => 'category-2'
            ],
            [
                'title' => "Category 3",
                'slug' => 'category-3'
            ],
        ]);

        $nbBlogCategories = 3;

        DB::table('blog_tags')->insert([
            ['tag' => 'Tag1', 'slug' => 'tag1'],
            ['tag' => 'Tag2', 'slug' => 'tag2'],
            ['tag' => 'Tag3', 'slug' => 'tag3'],
            ['tag' => 'Tag4', 'slug' => 'tag4'],
            ['tag' => 'Tag5', 'slug' => 'tag5'],
            ['tag' => 'Tag6', 'slug' => 'tag6']
        ]);

        $nbrBlogTags = 6;

        Blog::withoutEvents(function () {
            foreach (range(1, 10) as $i) {
                Blog::factory()->create([
                    "title" => "Post " . $i,
                    "slug" => "post-" . $i,
                    "seo_title" => "Post " . $i,
                    "image" => 'img0' . $i . '.jpg',
                ]);
            }
        });


        $nbBlogs = 10;

        $blogs = Blog::all();

        foreach ($blogs as $blog) {
            if ($blog->id === 9) {
                $numbers = [1, 2, 5, 6];
                $n = 4;
            } else {
                $numbers = range(1, $nbrBlogTags);
                shuffle($numbers);
                $n = rand(2, 4);
            }

            for ($i = 0; $i < $n; $i++) {
                $blog->tags()->attach($numbers[$i]);
            }
        }

        foreach ($blogs as $blog) {
            if ($blog->id === 9) {
                DB::table('blog_blog_category')->insert([
                    "blog_category_id" => 1,
                    "blog_id" => 9
                ]);
            } else {
                $numbers = range(1, $nbBlogCategories);
                shuffle($numbers);
                $n = rand(1, 2);
                for ($i = 0; $i < $n; $i++) {
                    DB::table('blog_blog_category')->insert([
                        "blog_category_id" => $numbers[$i],
                        "blog_id" => $blog->id
                    ]);
                }
            }
        }

        $faker = Factory::create();

        Contact::withoutEvents(function () {
            Contact::factory()->count(5)->create();
        });

        $items = [
            ['about-us', 'About us'],
            ['terms', 'Terms'],
            ['faq', 'FAQ'],
            ['privacy-policy', 'Privacy Policy'],
        ];

        foreach ($items as $item) {
            Page::factory()->create([
                'slug' => $item[0],
                'title' => $item[1],
            ]);
        }

        DB::table('download_categories')->insert([
            [
                'title' => "Category 1",
                'slug' => "category-1"
            ],
            [
                'title' => "Category 2",
                'slug' => "category-2"
            ],
            [
                'title' => "Category 3",
                'slug' => "category-3"
            ],
            [
                'title' => "Category 4",
                'slug' => "category-4"
            ],
        ]);

        $down_categories = DownloadCategory::all();

        foreach ($down_categories as $category) {
            DB::table('download_sub_categories')->insert([
                [
                    'title' => "Sub Category 1",
                    'slug' => "sub-category-$category->id-1",
                    "download_category_id" => $category->id
                ],
                [
                    'title' => "Sub Category 2",
                    'slug' => "sub-category-$category->id-2",
                    "download_category_id" => $category->id
                ],
                [
                    'title' => "Sub Category 3",
                    'slug' => "sub-category-$category->id-3",
                    "download_category_id" => $category->id
                ],
                [
                    'title' => "Sub Category 4",
                    'slug' => "sub-category-$category->id-4",
                    "download_category_id" => $category->id
                ],
            ]);
        }


        Download::withoutEvents(function () {
            $down_sub_categories = DownloadSubCategory::all();
            foreach ($down_sub_categories as $down_sub_category) {
                foreach (range(1, 10) as $i) {
                    $providers = ['steam', 'tfnet', 'tf_france', 'null'];
                    shuffle($providers);
                    $download = Download::factory()->create([
                        "title" => "Téléchargement " . $i,
                        "slug" => "telechargement-" . $down_sub_category->id . "-" . $i,
                        "seo_title" => "Téléchargement " . $i,
                        "image" => "img0" . $i . ".jpg",
                        "provider" => $providers[0],
                        "download_category_id" => $down_sub_category->download_category_id,
                        "download_sub_category_id" => $down_sub_category->id,
                    ]);

                    DB::table('download_user')->insert([
                        "download_id" => $download->id,
                        "user_id" => 1
                    ]);
                }
            }
        });

        $downloads = Download::all();
        $nbrDownload = count($downloads);

        foreach (range(1, $nbrDownload - 1) as $download) {
            DownloadVersion::factory()->create([
                'download_id' => $download,
                'user_id' => 1
            ]);
        }

        foreach ($downloads as $download) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                DownloadSupport::factory()->create([
                    "download_id" => $download,
                    "user_id" => 1
                ]);
            }

            for ($i = 0; $i < rand(1, 5); $i++) {
                DownloadSupport::factory()->create([
                    "download_id" => $download,
                    "email_user" => $faker->safeEmail,
                    "name_user" => $faker->name
                ]);
            }
        }

        foreach ($downloads as $download) {
            DownloadWiki::factory()->create([
                "download_id" => $download->id,
                "active" => true
            ]);
        }

        DB::table('follows')->insert([
            ["title" => "Twitter", "href" => "#", "icon" => "twitter"],
            ["title" => "Facebook", "href" => "#", "icon" => "facebook"],
            ["title" => "Instagram", "href" => "#", "icon" => "instagram"],
            ["title" => "Discord", "href" => "#", "icon" => "discord"],
            ["title" => "Steam", "href" => "#", "icon" => "steam"],
        ]);


    }
}
