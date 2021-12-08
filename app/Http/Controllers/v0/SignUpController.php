<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $user->fill($request->only(['email', 'password']))->save();
        $user->sendEmailVerificationNotification();
        return new UserResource($user);
    }
}
