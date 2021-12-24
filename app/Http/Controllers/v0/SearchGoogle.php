<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchGoogle extends Controller
{
    function __invoke(Request $request)
    {
        $filePath = __DIR__ . '/../../../Python/googleSearch.py';
        $python = 'python3';
        $word = $request->word;

        $command = $python . ' ' . $filePath . ' ' . $word;
        exec($command, $response);
        return $response[0];
    }
}
