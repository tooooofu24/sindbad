<?php

namespace Database\Factories;

use App\Models\Favorite;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Favorite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_ids = User::all()->pluck('id');
        $plan_ids = Plan::all()->pluck('id');
        $arr = $user_ids->crossJoin($plan_ids);
        // ユニークなuser_idとplan_idの組み合わせを生成
        $pair = $this->faker->unique()->randomElement($arr);
        return [
            'user_id' => $pair[0],
            'plan_id' => $pair[1],
        ];
    }
}
