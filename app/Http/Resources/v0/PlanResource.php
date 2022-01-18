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
            "favorites_count" => $this->favorites_count ?: 0,
            'url' => route('plans.show', ['id' => $this->id, 'uid' => $this->uid]),
            'start_date_time' => $this->start_date_time->toDateTimeString(),
            "user" => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'icon_url' => $this->user->icon_url,
            ],
            "planElements" => PlanElementResource::collection($this->planElements),
        ];
    }
}
