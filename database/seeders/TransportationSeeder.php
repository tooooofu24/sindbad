<?php

namespace Database\Seeders;

use App\Models\Transportation;
use Illuminate\Database\Seeder;

class TransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'その他'
            ],
            [
                'name' => '車'
            ],
            [
                'name' => '電車'
            ],
            [
                'name' => 'バス'
            ],
            [
                'name' => '飛行機'
            ],
            [
                'name' => '船'
            ],
            [
                'name' => '徒歩'
            ],
            [
                'name' => '自転車'
            ],
        ];
        Transportation::insert($data);
    }
}
