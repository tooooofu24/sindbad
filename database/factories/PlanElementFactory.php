<?php

namespace Database\Factories;

use App\Models\PlanElement;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanElementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlanElement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['spot', 'transportation']),
            'plan_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'spot_id' => $this->faker->numberBetween(1, 100),
            'transportation_id' => $this->faker->numberBetween(1, 100),
            'duration_min' => $this->faker->randomElement([30, 60, 90, 120]),
            'memo' => $this->faker->realText(20),
        ];
    }
}
