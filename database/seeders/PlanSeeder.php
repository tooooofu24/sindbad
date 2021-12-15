<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\PlanElement;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::factory()->count(20)->create()->each(function ($plan) {
            PlanElement::factory()->count(mt_rand(3, 10))->create(['plan_id' => $plan->id]);
        });
    }
}
