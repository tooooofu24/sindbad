<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 20),
            'plan_id' => $this->faker->numberBetween(1, 20),
            'admin_id' => null,
            'reason' => $this->faker->numberBetween(1, 5),
            'message' => $this->faker->realText(40),
        ];
    }
}
