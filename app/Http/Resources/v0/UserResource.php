<?php

namespace App\Http\Resources\v0;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $routeName = Route::currentRouteName();
        return [
            'id' => $this->id,
            'uid' => $this->uid,
            'name' => $this->name ?: '',
            'email' => $this->email ?: '',
            'icon_url' => $this->icon_url ?: '',
            'email_verified_at' => $this->email_verified_at ? $this->email_verified_at->toDateTimeString() : '',
            // registerの時だけパスワードの平文（初期値）を返す
            'password' => $this->when(
                Route::currentRouteName() == 'api.register',
                $this->password
            ),
            // registerかloginだったらtokenを発行
            'token' => $this->when(
                in_array(Route::currentRouteName(), ['api.register', 'api.login']),
                $this->createToken($this->id)->plainTextToken
            ),
        ];
    }
}
