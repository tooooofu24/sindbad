<?php

namespace App\Service;

class PythonService
{

    public static function googleSearch(string $q)
    {
        if (app()->isProduction()) {
            $python = '/opt/rh/rh-python38/root/usr/bin/python';
        } else {
            $python = 'python3';
        }
        $filePath = __DIR__ . '/Python/googleSearch.py';
        exec("$python $filePath $q", $response);
        return $response[0];
    }
}
