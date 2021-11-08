<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Spot_typesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spot_types = ['観光', '買い物', '宿', '体験', '遊び', '食事'];
        foreach ($spot_types as $spot_type) {
            DB::table('spot_types')->insert([
                'name' => $spot_type
            ]);
        }
    }
}
