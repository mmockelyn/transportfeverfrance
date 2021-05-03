<?php

namespace Database\Factories\Download;

use App\Models\Download\DownloadWiki;
use Illuminate\Database\Eloquent\Factories\Factory;

class DownloadWikiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DownloadWiki::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->paragraph(10, true)
        ];
    }
}
