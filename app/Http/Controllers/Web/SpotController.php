<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Spot;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
}
