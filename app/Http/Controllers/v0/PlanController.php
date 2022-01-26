<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Http\Requests\v0\ApiPlanRequest;
use App\Http\Resources\v0\PlanElementResource;
use App\Http\Resources\v0\PlanResource;
use App\Models\Plan;
use App\Models\PlanElement;
use App\Service\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            ->with([
                'user', 'planElements.spot', 'planElements.transportation',
            ])
            ->withCount(['favorites']);

        if ($request->is_mine) {
            $plans->where('user_id', $request->user()->id);
            $plans->latest();
            $size = $request->size ?: 20;
            return PlanResource::collection(
                $plans->paginate($size)
            );
        }

        // spotsのidでの絞り込み
        if (is_array($request->spots)) {
            foreach ($request->spots as $spot_id) {
                $plans->whereHas('planElements', function ($query) use ($spot_id) {
                    $query->where('child_id', $spot_id)->where('type', 1);
                });
            }
        }

        $plans->where('public_flag', true)->where('is_editing', false);
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
    public function store(ApiPlanRequest $request)
    {
        $plan = new Plan;
        $plan->fill($request->only([
            'title',
            'start_date_time',
        ]));
        $plan->public_flag = $request->public_flag ? 1 : 0;
        $plan->is_editing = $request->is_editing ? 1 : 0;
        $plan->user_id = $request->user()->id;
        $plan->save();
        if ($image = $request->file('thumbnail')) {
            $imageService = new ImageService($image);
            $image_path = $imageService->save($folder = 'plans', $file_name = $plan->uid);
            $plan->thumbnail_url = $image_path;
            $plan->save();
        }
        if ($request->plan_elements) {
            PlanElement::createFromRequest(
                json_decode($request->plan_elements, true),
                $plan->id
            );
        }
        return new PlanResource($plan);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $plan = Plan::findOrFail($id);
        if ($plan->public_flag == false && $plan->user_id != $request->user()->id) {
            return response('表示する権限がありません', 403)->header('Content-Type', 'text/plain');
        }
        return new PlanResource($plan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApiPlanRequest $request, $id)
    {
        $plan = Plan::with(['user', 'planElements'])->withCount(['favorites'])->findOrFail($id);
        if ($plan->user_id != $request->user()->id) {
            return response('編集する権限がありません', 403)->header('Content-Type', 'text/plain');
        }

        $plan->fill($request->only([
            'title',
            'start_date_time',
        ]));

        $plan->public_flag = $request->public_flag ? 1 : 0;
        $plan->is_editing = $request->is_editing ? 1 : 0;
        if ($image = $request->file('thumbnail')) {
            $imageService = new ImageService($image);
            $image_path = $imageService->save($folder = 'plans', $file_name = $plan->uid);
            $plan->thumbnail_url = $image_path;
        }
        $plan->save();
        return new PlanResource($plan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $plan = Plan::with(['favorites', 'planElements'])
            ->where('id', $id)->firstOrFail();
        if ($plan->user_id != $request->user()->id) {
            return response('削除する権限がありません', 403)->header('Content-Type', 'text/plain');
        }
        $plan->delete();
    }
}
