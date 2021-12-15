<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::where('uid', $request->uid)->firstOrFail();
        $user->tokens()->delete();
        if ($user->password == $request->password) {
            return new UserResource($user);
        } else {
            return response('パスワードが正しくありません', 401);
        }
    }
}
