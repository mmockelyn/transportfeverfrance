<?php

namespace Database\Factories\Download;

use App\Models\Download\DownloadVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

class DownloadVersionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DownloadVersion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'version' => str_replace(',', '.', $this->faker->randomFloat(2,1,5)),
            'link_packages' => $this->faker->url,
            'content' => $this->faker->paragraph($nb = 8, $asText = true),
            'type' => $this->faker->randomElement(['alpha', 'beta', 'release', 'hotfix']),
            'state' => rand(0,2)
        ];
    }
}
