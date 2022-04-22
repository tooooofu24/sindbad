<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginWithEmailController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        if (!Hash::check($request->password, $user->password)) {
            return response('パスワードが違います', 401)->header('Content-Type', 'text/plain');
        }
        if (!$user->hasVerifiedEmail()) {
            return response('認証が済んでいません', 401)->header('Content-Type', 'text/plain');
        }
        return new UserResource($user);
    }
}
