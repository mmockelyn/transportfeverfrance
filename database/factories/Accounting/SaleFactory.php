<?php

namespace Database\Factories\Accounting;

use App\Models\Accounting\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand = rand(0, 1);

        if($rand == 1) {
            $reference = Str::random(8);
        } else {
            $reference = null;
        }
        return [
            "reference" => $reference,
            "designation" => $this->faker->sentence(rand(2,8)),
            "amount" => $this->faker->randomFloat(2, 1, 350),
            "created_at" => Carbon::create('2021', rand(1,12), rand(1,30)),
            "updated_at" => Carbon::create('2021', rand(1,12), rand(1,30)),
        ];
    }
}
