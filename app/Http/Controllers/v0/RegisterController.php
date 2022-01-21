<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Http\Resources\v0\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = new User();
        // ランダムなパスワードのハッシュ値を生成
        $password = Str::random();
        $user->password = Hash::make($password);
        $user->save();
        // レスポンスでは登録時のみパスワードの平文を返す
        $user->password = $password;
        return new UserResource($user);
    }
}
