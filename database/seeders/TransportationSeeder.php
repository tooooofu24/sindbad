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
                'name' => '徒歩'
            ],
            [
                'name' => '電車'
            ],
            [
                'name' => '新幹線'
            ],
            [
                'name' => '車'
            ],
            [
                'name' => '船'
            ],
            [
                'name' => '自転車'
            ],
            [
                'name' => 'その他'
            ]
        ];
        Transportation::insert($data);
    }
}
