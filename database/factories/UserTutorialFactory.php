<?php

namespace Database\Factories;

use App\Models\UserTutorial;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTutorialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserTutorial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6, true)
        ];
    }
}
