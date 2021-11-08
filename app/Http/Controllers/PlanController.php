<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Favorite;
use App\Models\Plan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    // プラン作成
    public function create(Request $request)
    {
        try {
            $plan = new Plan;
            $plan->fill($request->only(['title', 'thumbnail_url', 'start_date_time', 'public_flag']));
            $plan->prefs = json_decode($request->prefs);
            $plan->user_id = $request->user()->id;
            $plan->save();
            $destinations = json_decode($request->destinations);
            foreach ($destinations as $d) {
                $destination = new Destination;
                $destination->plan_id = $plan->id;
                $destination->spot_id = $d->spot_id;
                $destination->duration_min = $d->duration_min;
                $destination->how_to_go = $d->how_to_go;
                $destination->required_min = $d->required_min;
                $destination->memo = $d->memo;
                $destination->move_memo = $d->move_memo;
                $destination->save();
            }
            return response()->json([
                'plan_id' => $plan->id
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    // プラン取得（全て）
    public function get_all(Request $request)
    {
        try {
            $user = $request->user();
            $plans = DB::select(
                "SELECT plans.id, plans.title, plans.thumbnail_url, plans.created_at, users.name AS user_name, users.icon_url AS user_icon_url, COALESCE(fav_counts.favorites_count, 0) AS favorites_count, spot_names.names AS spot_names
                FROM plans 
                LEFT JOIN users ON users.id = plans.user_id 
                LEFT JOIN (SELECT favorites.plan_id, COUNT(*) AS favorites_count FROM favorites GROUP BY plan_id) AS fav_counts ON plans.id = fav_counts.plan_id
                LEFT JOIN (
                    SELECT plan_id, GROUP_CONCAT(spot_name SEPARATOR '%%%') AS names 
                    FROM (
                        SELECT plans.id AS plan_id, spots.name AS spot_name 
                        FROM plans
                        LEFT JOIN destinations ON plans.id = destinations.plan_id
                        LEFT JOIN spots ON destinations.spot_id = spots.id
                    ) AS xxx
                    GROUP BY plan_id
                ) AS spot_names ON plans.id = spot_names.plan_id"
            );
            // $query = DB::select("SELECT plans.id 
            // FROM plans
            // LEFT JOIN (
            //     SELECT favorites.plan_id FROM favorites 
            //     WHERE user_id = 1
            // ) AS user_favs
            // ON plans.id = user_favs.plan_id");
            return response()->json([
                'items' => $plans
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    // プラン取得（1つ）
    public function get_one(Request $request, $id)
    {
        try {
            $plan = Plan::find($id);
            if ($plan->user_id !== $request->user()->id && !$plan->public_flag) {
                // 自分のものでないかつ非公開投稿の場合
                return response('Forbidden', 403);
            }
            $destinations = Destination::select(['spot_id', 'spots.name', 'spot_types.name as type', 'duration_min', 'how_to_go', 'required_min', 'spots.thumbnail_url', 'memo', 'move_memo'])->leftJoin('spots', 'destinations.spot_id', '=', 'spots.id')->leftJoin('spot_types', 'spot_types.id', '=', 'spots.spot_type_id')->where('plan_id', $id)->get();
            return response()->json([
                'id' => $plan->id,
                'title' => $plan->title,
                'thumbnail_url' => $plan->thumbnail_url,
                'start_date_time' => $plan->start_date_time,
                'prefs' => $plan->prefs,
                'favorites_count' => $plan->favorites->count(),
                'destinations' => $destinations
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    // プラン削除
    public function delete(Request $request, $id)
    {
        try {
            $plan = Plan::find($id);
            if (!$plan) {
                // 指定されたプランが存在しないとき
                return response('Not Found', 404);
            } elseif ($plan->user_id !== $request->user()->id) {
                // 指定されたプランが自分のものでないとき
                return response('Forbidden', 403);
            }
            Destination::where('plan_id', $plan->id)->delete();
            $plan->delete();
            return;
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    // プラン更新
    public function update(Request $request, $id)
    {
        try {
            $plan = Plan::find($id);
            if (!$plan) {
                // 指定されたプランが存在しないとき
                return response('Not Found', 404);
            } elseif ($plan->user_id !== $request->user()->id) {
                // 指定されたプランが自分のものでないとき
                return response('Forbidden', 403);
            }
            $plan->fill($request->only(['title', 'thumbnail_url', 'start_date_time', 'public_flag']));
            $plan->prefs = json_decode($request->prefs);
            $plan->save();
            Destination::where('plan_id', $plan->id)->delete();
            $destinations = json_decode($request->destinations);
            foreach ($destinations as $d) {
                $destination = new Destination;
                $destination->plan_id = $plan->id;
                $destination->spot_id = $d->spot_id;
                $destination->duration_min = $d->duration_min;
                $destination->how_to_go = $d->how_to_go;
                $destination->required_min = $d->required_min;
                $destination->memo = $d->memo;
                $destination->move_memo = $d->move_memo;
                $destination->save();
            }
            return;
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
