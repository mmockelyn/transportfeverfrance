<?php

namespace Database\Factories\Blog;

use App\Models\Blog\BlogComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "content" => $this->faker->sentence($nbSentences = 4, $variableNbSentences = true)
        ];
    }
}
