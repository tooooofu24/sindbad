<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->user()->isAdmin()) {
            return $request->user();
        } else {
            return response('Unauthorized', 401)->header('Content-Type', 'text/plain');
        }
    }
}
