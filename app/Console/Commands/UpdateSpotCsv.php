<?php

namespace App\Console\Commands;

use App\Models\Spot;
use Illuminate\Console\Command;
use League\Csv\Writer;

class UpdateSpotCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spotデータのcsvを更新';

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
        $writer = Writer::createFromPath(base_path("database/seeders/spotData.csv"), 'w+');
        foreach (Spot::all() as $spot) {
            $writer->insertOne([
                $spot->name,
                $spot->converted_name,
                $spot->thumbnail_url,
                $spot->pref
            ]);
        }
    }
}
