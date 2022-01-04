<?php

namespace Database\Factories\Wiki;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WikiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            "title" => $title,
            "slug" => Str::slug($title),
            "contents" => $this->faker->realText,
            "published" => rand(0, 2)
        ];
    }
}
