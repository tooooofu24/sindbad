<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Spot;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->realText($this->faker->numberBetween(10, 30)),
            'thumbnail_url' => Spot::inRandomOrder()->first()->thumbnail_url,
            'start_date_time' => $this->faker->dateTime(),
            'public_flag' => $this->faker->boolean(),
        ];
    }
}
