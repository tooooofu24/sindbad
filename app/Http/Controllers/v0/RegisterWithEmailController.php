<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Http\Resources\v0\UserResource;
use Illuminate\Http\Request;

class RegisterWithEmailController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $user->fill($request->only(['email', 'password']))->save();
        $user->sendEmailVerificationNotification();
        return new UserResource($user);
    }
}
