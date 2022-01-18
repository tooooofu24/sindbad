<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Http\Requests\v0\ApiSpotRequest;
use App\Http\Resources\v0\SpotResource;
use App\Models\Spot;
use App\Service\ConvertTextService;
use App\Service\PythonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Spot::query();
        // ->withCount('planElements')
        // ->orderBy('plan_elements_count', 'desc');
        $size = $request->size ?: 20;
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

        return SpotResource::collection($query->paginate($size));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiSpotRequest $request)
    {
        $spot = new Spot();
        $spot->fill(
            $request->only(['name', 'pref'])
        );
        $python = new PythonService;
        $thumbnail_url = $python->googleSearch($request->name);
        $spot->thumbnail_url = $thumbnail_url;
        $spot->converted_name = ConvertTextService::convert($request->name);
        $spot->save();
        return new SpotResource($spot);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApiSpotRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
