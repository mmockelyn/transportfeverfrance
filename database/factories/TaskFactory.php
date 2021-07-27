<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "category" => $this->faker->sentence,
            "task" => $this->faker->sentence,
            "description" => $this->faker->realText,
            "check" => rand(0,1)
        ];
    }
}
