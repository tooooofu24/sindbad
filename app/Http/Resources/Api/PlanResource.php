<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "title" => $this->title,
            "thumbnail_url" => $this->thumbnail_url ?: '',
            "favorites_count" => $this->favorites_count == null ? count($this->favorites) : $this->favorites_count,
            'url' => $this->url,
            'start_date_time' => $this->start_date_time->toDateTimeString(),
            'is_editing' => $this->is_editing,
            'is_liked' => $this->isLiked,
            'public_flag' => $this->public_flag,
            'parent_plan' => $this->parentPlan
                ? [
                    'id' => $this->parentPlan->id,
                    'title' => $this->parentPlan->title,
                    'thumbnail_url' => $this->parentPlan->thumbnail_url,
                    'user' => new PublicUserResource($this->parentPlan->user),
                ]
                : null,
            "user" => new PublicUserResource($this->user),
            "planElements" => PlanElementResource::collection($this->planElements),
        ];
    }
}
