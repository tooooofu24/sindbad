<?php

namespace Database\Seeders;

use App\Models\PlanElement;
use Illuminate\Database\Seeder;

class PlanElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlanElement::factory()->count(10)->create();
    }
}
