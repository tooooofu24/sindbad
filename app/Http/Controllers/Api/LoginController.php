<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::where('uid', $request->uid)->firstOrFail();
        if (Hash::check($request->password, $user->password)) {
            $user->tokens()->delete();
            return new UserResource($user);
        } else {
            return response('パスワードが正しくありません', 401)->header('Content-Type', 'text/plain');
        }
    }
}
