<?php

namespace App\Console\Commands;

use App\Models\Spot;
use App\Service\PythonService;
use Illuminate\Console\Command;

class FixSpotImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:spot-image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'faviconになっていたサムネイルの修正コマンド';

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
        $spots = Spot::orWhere('thumbnail_url', 'like', 'https://encrypted-tbn2.gstatic.com/faviconV2?url=%')
            ->get();
        foreach ($spots as $i => $spot) {
            $spot->thumbnail_url = PythonService::googleSearch($spot->name);
            $spot->save();
        }
        return Command::SUCCESS;
    }
}
