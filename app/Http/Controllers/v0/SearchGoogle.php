<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Service\PythonService;
use Illuminate\Http\Request;

class SearchGoogle extends Controller
{
    function __invoke(Request $request)
    {
        $response = PythonService::googleSearch($request->q);
        return response($response, 200)->header('Content-Type', 'text/plain');
    }
}
