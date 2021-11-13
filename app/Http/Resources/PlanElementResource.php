<?php

namespace App\Http\Resources;

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
        if ($this->child instanceof Spot) { // spot
            $child = new SpotResource($this->child);
        } elseif ($this->child instanceof Transportation) { //transportation
            $child = new TransportationResource($this->child);
        } else { // blank
            $child = null;
        }
        return [
            'id' => $this->id,
            'plan_id' => $this->plan_id,
            'type' => $this->type, // 0 => blank, 1 => spot, 2 => transportation
            'duration_min' => $this->duration_min,
            'child' => $child,
            'memo' => $this->when($this->type !== 0, $this->memo), // blankは表示しない
        ];
    }
}
