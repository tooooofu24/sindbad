<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Spot;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    public function index(Request $request)
    {
        $query = Spot::query();
        $spots = $query->paginate(12);
        return view('spots.index', compact(['spots']));
    }
}
