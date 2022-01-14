<?php

namespace App\Jobs;

use App\Models\Spot;
use App\Service\ConvertTextService;
use App\Service\PythonService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SpotUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * @param Request $request
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $spot = new Spot();
        $spot->fill([
            'name' => $this->data['name'],
            'converted_name' => ConvertTextService::convert($this->data['name']),
            'pref' => $this->data['pref'],
            'thumbnail_url' => PythonService::googleSearch($this->data['name']),
        ])->save();
    }
}
