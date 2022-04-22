<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\PublicUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            "id" => $this->id,
            "user_id" => $this->user_id,
            "plan_id" => $this->plan_id,
            "admin_id" => $this->admin_id,
            "reason" => $this->reason,
            "message" => $this->message,
            "plan" => [
                "title" => $this->plan->title,
                "url" => $this->plan->url,
                "user" => new PublicUserResource(optional($this->plan)->user)
            ]
        ];
    }
}
