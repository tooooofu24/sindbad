<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerifyController extends Controller
{
    public function completeVerification()
    {
        return view('completeVerification');
    }

    public function failVerification()
    {
        return view('failVerification');
    }
}
