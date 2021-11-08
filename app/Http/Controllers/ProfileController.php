<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        try {
            $user = $request->user();
            $user->name = $request->name;
            $user->icon_url = $request->icon_url;
            $user->save();
            return;
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
