<?php

namespace App\Console\Commands;

use App\Models\Spot;
use Exception;
use Illuminate\Console\Command;
use League\Csv\Reader;

class ImportCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importCsv:gurutabi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ぐるなびのデータをインポート';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reader = Reader::createFromPath(__DIR__ . '/test.csv', 'r');
        $records = $reader->getRecords();
        foreach ($records as $record) {
            $spot = new Spot();
            try {
                $spot->fill([
                    'name' => $record[0],
                    'converted_name' => $record[1],
                    'thumbnail_url' => $record[2],
                    'pref' => $record[3]
                ])->save();
            } catch (Exception $e) {
                dump($e->getMessage());
            }
        }
    }
}
