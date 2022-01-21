<?php

namespace Database\Seeders;

use App\Models\Spot;
use Exception;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class SpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // csvでインポート
        $reader = Reader::createFromPath(__DIR__ . '/spotData.csv', 'r');
        $records = $reader->getRecords();
        $data = [];
        $status_list = [-10, 0, 10];
        foreach ($records as $i => $record) {
            $data[] = [
                'name' => $record[0],
                'converted_name' => $record[1],
                'thumbnail_url' => $record[2],
                'pref' => $record[3],
                // 'status' => $record[4], // 認証済み
                'status' => 10, // 認証済み
                // 'count' => $record[5],
                'count' => 0,
            ];
        }
        $insert_data = collect($data);
        foreach ($insert_data->chunk(500) as $chunk) {
            Spot::insert($chunk->toArray());
        }
    }
}
