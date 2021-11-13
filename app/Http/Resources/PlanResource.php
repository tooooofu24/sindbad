<?php

namespace App\Http\Resources;

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
            "thumbnail_url" => $this->thumbnail_url,
            "favorites_count" => $this->favorites->count(),
            "user" => new UserResource($this->user),
            "planElements" => PlanElementResource::collection($this->planElements),
        ];
    }
}
