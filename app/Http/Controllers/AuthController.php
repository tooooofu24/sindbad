<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
            $user = $request->user();
            $user->fill($request->only(['email', 'password']));
            $user->save();
            return;
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function login(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if ($user->password == $request->password) {
                    $user->tokens()->delete();
                    return response()->json([
                        'name' => $user->name,
                        'uid' => $user->uid,
                        'token' => $user->createToken($user->uid)->plainTextToken
                    ]);
                } else {
                    return response()->json([
                        'res' => 'ログイン失敗です'
                    ]);
                }
            } else {
                return response('Not Found', 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'res' => $e->getMessage()
            ]);
        }
    }
}
