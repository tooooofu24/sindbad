<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function test()
    {
    }
    public function signup(Request $request)
    {
        try {
            $user = new User;
            $uid = Str::uuid();
            $user->uid = $uid;
            $user->password = Hash::make($uid);
            $user->signed_flag = false;
            $user->save();
            // アクセストークンを発行
            $token = $user->createToken($user->uid);

            return response()->json([
                'id' => $user->uid,
                'password' => $user->password,
                'token' => $token->plainTextToken,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $user = User::where('uid', $request->uid)->first();
            if ($user) {
                $user->tokens()->delete();
                if ($user->password == $request->password) {
                    return response()->json([
                        'name' => $user->name,
                        'email' => $user->email,
                        'token' => $user->createToken($user->uid)->plainTextToken,
                    ]);
                } else {
                    return response('Unauthorized', 401);
                }
            } else {
                return response('Not Found', 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }


    public function redirect()
    {
        return response('Unauthorized', 401);
    }
}
