<?php

namespace Database\Factories\Download;

use App\Models\Download\DownloadSupport;
use Illuminate\Database\Eloquent\Factories\Factory;

class DownloadSupportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DownloadSupport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->sentence(4, true),
            'message' => $this->faker->paragraph($nbSentences = 4, $variableNbSentences = true),
            'state' => rand(0,3)
        ];
    }
}
