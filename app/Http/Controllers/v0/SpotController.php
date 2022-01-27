<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Http\Requests\v0\ApiSpotRequest;
use App\Http\Resources\v0\SpotResource;
use App\Jobs\UpdateSpotImageJob;
use App\Models\Spot;
use App\Service\GooApiService;
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

        $size = $request->size ?: 20;
        if ($request->q) {
            $query->ofSearch($request->q);
        } else {
            $query->orderBy('count');
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
        $spot->converted_name = GooApiService::convert($request->name);
        $spot->save();
        UpdateSpotImageJob::dispatch($spot->id);
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
