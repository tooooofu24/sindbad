<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpotCsvUploadRequst;
use App\Http\Requests\SpotUploadRequst;
use App\Jobs\CsvSpotUploadJob;
use App\Jobs\SpotUploadJob;
use App\Models\Spot;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class SpotController extends Controller
{
    public function index(Request $request)
    {
        $query = Spot::query()
            ->withCount('planElements')
            ->orderBy('plan_elements_count', 'desc');;
        if ($request->q) {
            // スペース区切りの検索文字を配列にする
            $words = preg_split('/[\s|\x{3000}]+/u', $request->q);
            foreach ($words as $word) {
                $query->where(function ($query) use ($word) {
                    $query->orWhere('name', 'like', "%$word%")
                        ->orWhere('converted_name', 'like', "%$word%");
                });
            }
        }
        if ($request->pref) {
            $query->where('pref', 'like', "%{$request->pref}%");
        }
        if ($request->is_null) {
            $query->where('thumbnail_url', '');
        }
        $spots = $query->paginate(24);
        return view('spots.index', compact(['spots']));
    }

    public function updateImage($id, Request $request)
    {
        $spot = Spot::findOrFail($id);
        try {
            $image = $request->file('image');
            $image_path = Storage::disk('s3')->put('/test', $image, 'public');
            $url = env('AWS_BASE_URL') . $image_path;
            $spot->thumbnail_url = $url;
            $spot->save();
            return redirect()
                ->route('spots.index', $request->query())
                ->with('message', '更新しました！');
        } catch (\Exception $e) {
            return redirect()
                ->route('spots.index', $request->query())
                ->with('error_message', $e->getMessage());
        }
    }

    public function create()
    {
        return view('spots.create');
    }

    public function storeWithCsv(SpotCsvUploadRequst $request)
    {
        $reader = Reader::createFromPath($request->file('csv')->getPathname(), 'r');
        $records = $reader->getRecords();

        $data = [];
        foreach ($records as $record) {
            $data[] = $record;
        }

        // Spotを保存(非同期)
        CsvSpotUploadJob::dispatch($data);

        return redirect()->route('spots.create.index')->with('message', '登録しました！(反映に時間がかかることがあります)');
    }

    public function store(SpotUploadRequst $request)
    {
        // Spotを保存(非同期)
        SpotUploadJob::dispatch($request->all());

        return redirect()->route('spots.create.index')->with('message', '登録しました！');
    }
}
