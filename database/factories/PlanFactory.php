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
            'title' => $this->faker->randomElement(Consts::PREF_LIST) . $this->faker->randomElement(['旅行', 'の旅', 'を巡る旅', '温泉旅行', ' グルメの旅', ' ナンパの旅', 'のラーメンを巡る', ' 美術館巡り', ' カフェ巡り', ' 卒業旅行']),
            // 'thumbnail_url' => Spot::where('thumbnail_url', '<>', '')->inRandomOrder()->first()->thumbnail_url,
            'thumbnail_url'=>null,
            'start_date_time' => $this->faker->dateTime(),
            'public_flag' => true,
        ];
    }
}
