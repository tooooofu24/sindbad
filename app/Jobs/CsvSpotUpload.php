<?php

namespace App\Jobs;

use App\Models\Spot;
use App\Service\ConvertTextService;
use App\Service\PythonService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * CSVアップロードの非同期処理
 */
class CsvSpotUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $records;

    /**
     * @param mixed $records
     */
    public function __construct($records)
    {
        $this->records = $records;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->records as $record) {
            try {
                $name = $record[0];
                $pref = $record[1];
                // 「観光地」がタイトルのデータは弾く
                if ($name == '観光地名') {
                    continue;
                }
                // 既に存在するデータは弾く
                if (Spot::where('name', $name)->where('pref', $pref)->exists()) {
                    continue;
                }
                $converted_name = ConvertTextService::convert($name);
                $thumbnail_url = PythonService::googleSearch($name);
                $spot = new Spot();
                $spot->fill([
                    'name' => $name,
                    'converted_name' => $converted_name,
                    'pref' => $pref,
                    'thumbnail_url' => $thumbnail_url,
                ])->save();
            } catch (Exception $e) {
                continue;
            }
        }
    }
}
