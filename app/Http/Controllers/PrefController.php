<?php

namespace App\Http\Controllers;

use App\Models\Pref;
use Exception;
use Illuminate\Http\Request;

class PrefController extends Controller
{
    public function get(Request $request)
    {
        try {
            $prefs = Pref::all();
            return response()->json([
                'res' => $prefs
            ]);
        } catch (Exception $e) {
            return response()->json([
                'res' => $e->getMessage()
            ]);
        }
    }
}
