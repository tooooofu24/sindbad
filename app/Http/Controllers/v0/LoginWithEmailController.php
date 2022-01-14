<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Http\Resources\v0\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class LoginWithEmailController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        if ($user->password !== $request->password) {
            return response('パスワードが違います', 401);
        }
        if (!$user->hasVerifiedEmail()) {
            return response('認証が済んでいません', 401);
        }
        return new UserResource($user);
    }
}
