<?php

namespace Database\Factories;

use App\Models\Plan;
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
        $categories = [
            'abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife',
            'fashion', 'people', 'nature', 'sports', 'technics', 'transport'
        ];
        return [
            'user_id' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->realText(10),
            'thumbnail_url' => $this->faker->boolean(50) ? $this->faker->imageUrl($width = 640, $height = 480, $category = $categories[mt_rand(0, 12)]) : null,
            'start_date_time' => $this->faker->dateTime(),
            'public_flag' => $this->faker->boolean(),
        ];
    }
}
