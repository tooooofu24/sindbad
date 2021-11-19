<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\Plan;
use App\Models\PlanElement;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UserSeeder::class]);
        User::factory()->count(9)->create();
        Plan::factory()->count(10)->create()->each(function ($plan) {
            PlanElement::factory()->count(mt_rand(3, 10))->create(['plan_id' => $plan->id]);
        });
        $this->call([
            SpotSeeder::class,
            TransportationSeeder::class
        ]);
        // Favoriteは最後に作成
        Favorite::factory()->count(20)->create();
    }
}
