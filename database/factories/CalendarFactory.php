<?php

namespace Database\Factories;

use App\Models\Calendar;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Calendar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_date = $this->faker->dateTimeInInterval(now());
        $start_time = $this->faker->time;
        return [
            "description" => $this->faker->paragraph,
            "start_date" => $start_date,
            "start_time" => $start_time,
            "end_date" => $this->faker->dateTimeInInterval($start_date, '+'.rand(1,15).' days'),
            "end_time" => $this->faker->time
        ];
    }
}
