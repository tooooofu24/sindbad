<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\FavoriteResource;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->with(['plan.planElements.spot', 'plan.planElements.transportation', 'plan.user', 'plan.parentPlan.user'])
            ->latest()
            ->paginate();
        return FavoriteResource::collection($favorites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = $request->user()->id;
        // 既にお気に入り済みの場合は何もしない
        if (Favorite::where('user_id', $user_id)->where('plan_id', $request->plan_id)->exists()) {
            return;
        }
        $favorite = new Favorite();
        $favorite->user_id = $user_id;
        $favorite->plan_id = $request->plan_id;
        $favorite->save();
        return new FavoriteResource($favorite);
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
    public function destroy($id, Request $request)
    {
        $favorite = Favorite::findOrFail($id);
        $this->authorize('delete', $favorite);
        $favorite->delete();
        return;
    }
}
