<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiPlanRequest;
use App\Http\Resources\Api\PlanElementResource;
use App\Http\Resources\Api\PlanResource;
use App\Models\Plan;
use App\Models\PlanElement;
use App\Service\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            ->withAllRelations()
            ->whereNotIn('user_id', Auth::user()->blockUserIdList)
            ->where('public_flag', true)
            ->where('is_editing', false)
            ->latest();

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
            'parent_id'
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
        $plan = Plan::withAllRelations()->findOrFail($id);
        $this->authorize('view', $plan);
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
        $plan = Plan::withAllRelations()->findOrFail($id);
        $this->authorize('update', $plan);

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
        $plan->deleteElements();
        if ($request->plan_elements) {
            PlanElement::createFromRequest(
                json_decode($request->plan_elements, true),
                $plan->id
            );
        }
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
        $plan = Plan::withAllRelations()->findOrFail($id);
        $this->authorize('delete', $plan);
        $plan->delete();
        return ['message' => 'Success'];
    }
}
