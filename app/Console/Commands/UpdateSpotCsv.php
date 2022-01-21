<?php

namespace App\Console\Commands;

use App\Models\Spot;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
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
        Log::debug('自動更新スタート');
        $writer = Writer::createFromPath(base_path("database/seeders/spotData.csv"), 'w+');
        // メモリ節約のため、1000軒ずつ取得
        Spot::withCount('planElements')->chunk(1000, function ($spots) use ($writer) {
            foreach ($spots as $spot) {
                $writer->insertOne([
                    $spot->name,
                    $spot->converted_name,
                    $spot->thumbnail_url,
                    $spot->pref,
                    $spot->status,
                    $spot->plan_elements_count,
                ]);
                $spot->count = $spot->plan_elements_count;
                $spot->save();
            }
        });
        Log::debug('自動更新終了');
    }
}
