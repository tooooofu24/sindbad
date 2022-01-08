<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpotCsvUploadRequst;
use App\Http\Requests\SpotUploadRequst;
use App\Jobs\CsvSpotUpload;
use App\Jobs\SpotUpload;
use App\Models\Spot;
use App\Service\ConvertTextService;
use App\Service\PythonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use League\Csv\CharsetConverter;
use League\Csv\Reader;

class SpotUploadController extends Controller
{
    public function index()
    {
        return view('spotUpload');
    }

    public function csvUpload(SpotCsvUploadRequst $request)
    {
        $reader = Reader::createFromPath($request->file('csv')->getPathname(), 'r');
        $records = $reader->getRecords();

        // Spotを保存(非同期)
        CsvSpotUpload::dispatch($records);

        return redirect()->route('spotUpload.index')->with('message', '登録しました！(反映に時間がかかることがあります)');
    }

    public function upload(SpotUploadRequst $request)
    {
        // Spotを保存(非同期)
        SpotUpload::dispatch($request->all());

        return redirect()->route('spotUpload.index')->with('message', '登録しました！');
    }
}
