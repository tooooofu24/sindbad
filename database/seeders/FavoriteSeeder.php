<?php

namespace Database\Seeders;

use App\Models\Favorite;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Favorite::factory()->count(10000)->create();
        $data = [];
        for ($i = 0; $i < 10000; $i++) {
            $data[] = [
                'user_id' => mt_rand(1, 20),
                'plan_id' => mt_rand(1, 100),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }
        Favorite::insert($data);
    }
}
