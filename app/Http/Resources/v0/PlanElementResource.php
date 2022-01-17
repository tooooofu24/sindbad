<?php

namespace App\Http\Resources\v0;

use App\Models\Spot;
use App\Models\Transportation;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanElementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->type == 0) {
            $child = null;
        } elseif ($this->type == 1) {
            $child = new SpotResource($this->spot);
        } else {
            $child = new TransportationResource($this->transportation);
        }
        return [
            'id' => $this->id,
            'plan_id' => $this->plan_id,
            'type' => $this->type, // 0 => blank, 1 => spot, 2 => transportation
            'duration_min' => $this->duration_min,
            'memo' => $this->when($this->type > 0, $this->memo), // blankは表示しない
            'child' => $child,
        ];
    }
}
