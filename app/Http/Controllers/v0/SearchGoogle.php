<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchGoogle extends Controller
{
    function __invoke(Request $request)
    {
        if (app()->isProduction()) {
            $python = '/opt/rh/rh-python38/root/usr/bin/python';
        } else {
            $python = 'python3';
        }
        $filePath = __DIR__ . '/../../../Python/googleSearch.py';

        $command = $python . ' ' . $filePath . ' ' . $request->q;
        exec($command, $response);
        return $response[0];
    }
}
