<?php

namespace App\Http\Resources\v0;

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
            'url' => $this->user_id == $request->user()->id ? route('plans.show', ['id' => $this->id, 'uid' => $this->uid]) : route('plans.show', ['id' => $this->id]),
            'start_date_time' => $this->start_date_time->toDateTimeString(),
            'is_editing' => $this->is_editing,
            'public_flag' => $this->public_flag,
            "user" => new PublicUserResource($this->user),
            "planElements" => PlanElementResource::collection($this->planElements),
        ];
    }
}
