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
        $type = $this->faker->numberBetween(0, 2); // 0 => blank, 1 => spot, 2 => transportation
        // typeによってリレーション先が変わる
        if ($type == 0) { // blank
            $child_id = null;
        } elseif ($type == 1) { // spot
            $child_id = $this->faker->numberBetween(1, 100);
        } else { // transportation
            $child_id = $this->faker->numberBetween(1, 7);
        }
        return [
            'type' => $type, // 0 => blank, 1 => spot, 2 => transportation
            'child_id' => $child_id,
            'duration_min' => $this->faker->randomElement([10, 20, 30, 40, 50, 60, 70, 80, 90]),
            'memo' => $this->faker->boolean(50) ? $this->faker->realText(20) : null,
        ];
    }
}
