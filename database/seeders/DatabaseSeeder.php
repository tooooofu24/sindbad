<?php

namespace Database\Seeders;

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
        $this->call([
            // UserSeeder::class,
            TransportationSeeder::class,
            // PlanSeeder::class,
            SpotSeeder::class,
            // Favoriteは最後に作成
            // FavoriteSeeder::class,
            AdminSeeder::class,
            // ReportSeeder::class,
        ]);
    }
}
