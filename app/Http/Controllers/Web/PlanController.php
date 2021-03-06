<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
    }

    public function show($id, Request $request)
    {
        $plan = Plan::with([
            'planElements.spot', 'planElements.transportation', 'planElements.plan'
        ])->withTrashed()->findOrFail($id);

        if (!$plan->public_flag && $request->uid != $plan->uid) {
            abort(404);
        }
        return view('plans.show', compact(['plan']));
    }
}
