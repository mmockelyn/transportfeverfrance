<?php

namespace Database\Factories\Download;

use App\Models\Download\Download;
use Illuminate\Database\Eloquent\Factories\Factory;

class DownloadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Download::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'meta_description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'meta_keywords' => implode(',', $this->faker->words($nb = 3, $asText = false)),
            'short_content' => $this->faker->paragraph($nbSentences = 4, $variableNbSentences = true),
            'content' => $this->faker->paragraph($nb = 8, $asText = true),
            'active' => true
        ];
    }
}
