<?php

namespace App\Jobs;

use App\Models\Spot;
use App\Service\PythonService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Spotのサムネイル画像を非同期で更新するメソッド
 */
class UpdateSpotImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $spot;
    /**
     * 
     * @param mixed $id Spotのid
     */
    public function __construct($id)
    {
        $this->spot = Spot::findOrFail($id);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->spot->thumbnail_url = PythonService::googleSearch($this->spot->name);
        $this->spot->save();
    }
}
