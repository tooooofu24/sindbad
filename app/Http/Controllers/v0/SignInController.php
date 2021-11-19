<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        if ($user->password !== $request->password) {
            return response('パスワードが違います', 401);
        }
        return new UserResource($user);
    }
}
