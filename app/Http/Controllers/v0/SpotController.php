<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Http\Resources\v0\SpotResource;
use App\Models\Spot;
use Illuminate\Http\Request;

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
        $size = $request->size ?: 20;
        if ($request->q) {
            // スペース区切りの検索文字を配列にする
            $words = preg_split('/[\s|\x{3000}]+/u', $request->q);
            foreach ($words as $word) {
                $query->where(function ($q) use ($word) {
                    $q->orWhere('name', 'like', "%$word%")
                        ->orWhere('converted_name', 'like', "%$word%");
                });
            }
        }
        $query = Spot::where('id', 1);
        return $query->paginate($size);
        return SpotResource::collection($query->paginate($size));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $spot = new Spot();
        $spot->fill(
            $request->only(['name', 'converted_name', 'thumbnail_url', 'pref'])
        )->save();
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
    public function update(Request $request, $id)
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
