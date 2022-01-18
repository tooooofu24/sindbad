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
        foreach ($records as $record) {
            $spot = new Spot();
            try {
                $spot->fill([
                    'name' => $record[0],
                    'converted_name' => $record[1],
                    'thumbnail_url' => $record[2],
                    'pref' => $record[3],
                    'status' => 10, // 認証済み
                ])->save();
            } catch (Exception $e) {
                dump($e->getMessage());
                continue;
            }
        }
    }
}
