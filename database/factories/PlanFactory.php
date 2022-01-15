<?php

namespace Database\Factories;

use App\Consts\Consts;
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
            'user_id' => $this->faker->numberBetween(1, 20),
            'title' => $this->faker->randomElement(Consts::PREF_LIST),
            'thumbnail_url' => Spot::where('thumbnail_url', '<>', '')->inRandomOrder()->first()->thumbnail_url,
            'start_date_time' => $this->faker->dateTime(),
            'public_flag' => true,
        ];
    }
}
