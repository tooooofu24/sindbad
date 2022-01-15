<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Http\Resources\v0\PlanElementResource;
use App\Http\Resources\v0\PlanResource;
use App\Models\Plan;
use App\Models\PlanElement;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $plans = Plan::query()
            ->with(['user', 'favorites', 'planElements']);
        if ($request->is_mine) {
            $plans->where('user_id', $request->user()->id);
        }

        // spotsのidでの絞り込み
        if ($request->spots && is_array($request->spots)) {
            foreach ($request->spots as $spot_id) {
                $plans->whereHas('planElements', function ($query) use ($spot_id) {
                    $query->where('child_id', $spot_id)->where('type', 1);
                });
            }
        }
        $plans->latest();
        $size = $request->size ?: 20;
        return PlanResource::collection(
            $plans->paginate($size)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plan = new Plan;
        $plan->fill($request->all());
        $plan->user_id = $request->user()->id;
        $plan->save();
        PlanElement::createFromRequest(
            json_decode($request->plan_elements, true),
            $plan->id
        );
        return new PlanResource($plan);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PlanResource(
            Plan::findOrFail($id)
        );
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
        $plan = Plan::findOrFail($id)
            ->with(['user', 'favorites', 'planElements']);
        if ($plan->user_id !== $request->user()->id) {
            return response('削除する権限がありません', 403);
        }
        $plan->deletePlanElements();
        PlanElement::createFromRequest(
            json_decode($request->plan_elements, true),
            $plan->id
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $plan = Plan::with(['user', 'favorites', 'planElements'])
            ->where('id', $id)->firstOrFail();
        if ($plan->user_id !== $request->user()->id) {
            return response('削除する権限がありません', 403);
        }
        $plan->deletePlanElements();
        $plan->delete();
    }
}
