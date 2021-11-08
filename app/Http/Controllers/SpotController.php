<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpotController extends Controller
{
    public function create(Request $request)
    {
        try {
            $spot = new Spot;
            $spot->thumbnail_url = $request->input('thumbnail_url');
            $spot->name = $request->input('name');
            $spot->spot_type_id = $request->input('type');
            $spot->pref = $request->input('pref');
            $spot->save();
            return;
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function get(Request $request)
    {
        try {
            $pref = $request->input('pref');
            $spot_type_id = $request->input('spot_type_id');
            $spots_query = Spot::select(['spots.id as spot_id', 'spots.name as name', 'spot_types.name as type'])->leftJoin('spot_types', 'spot_types.id', '=', 'spots.spot_type_id');
            if ($pref) {
                $spots_query = $spots_query->where('pref', $pref);
            }
            if ($spot_type_id) {
                $spots_query = $spots_query->where('spot_type_id', $spot_type_id);
            }
            $spots = $spots_query->get();
            return response()->json([
                'items' => $spots
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
