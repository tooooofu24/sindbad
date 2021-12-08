<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Features;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'icon_url' => $this->faker->imageUrl(),
            'name' => $this->faker->name(),
            'email' => $this->faker->boolean(50) ? $this->faker->unique()->safeEmail() : null,
        ];
    }
}
