<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::factory()->count(10)->create();
    }
}
