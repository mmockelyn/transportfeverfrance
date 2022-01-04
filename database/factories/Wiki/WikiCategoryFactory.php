<?php

namespace Database\Factories\Wiki;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WikiCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(2);
        return [
            "title" => $title,
            "slug" => Str::slug($title)
        ];
    }
}
