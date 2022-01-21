<?php

namespace App\Http\Resources\v0;

use Illuminate\Http\Resources\Json\JsonResource;

class SpotResource extends JsonResource
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
            'name' => $this->name,
            'converted_name' => $this->converted_name ?: '',
            'thumbnail_url' => $this->thumbnail_url ?: '',
            'pref' => $this->pref,
            'count' => $this->count ?: 0,
        ];
    }
}
