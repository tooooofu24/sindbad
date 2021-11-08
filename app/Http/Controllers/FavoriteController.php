<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Exception;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // お気に入り登録メソッド
    public function fav(Request $request, $plan_id)
    {
        try {
            $user_id = $request->user()->id;
            // 既にお気に入り済みの場合は何もしない
            if (Favorite::where('user_id', $user_id)->where('plan_id', $plan_id)->exists()) {
                return response()->json([
                    'error' => '既にお気に入り済みです'
                ]);
            } else {
                $favorite = new Favorite;
                $favorite->user_id = $user_id;
                $favorite->plan_id = $plan_id;
                $favorite->save();
                return;
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    // お気に入り削除メソッド
    public function delete(Request $request, $plan_id)
    {
        try {
            $user_id = $request->user()->id;
            $query = Favorite::where('user_id', $user_id)->where('plan_id', $plan_id);
            if ($query->exists()) {
                $query->delete();
                return;
            } else {
                return response()->json([
                    'error' => '該当のレコードが存在しないか既に削除されています'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    // 自分のお気に入り済みのplan_idを返す
    public function get(Request $request)
    {
        try {
            $user_id = $request->user()->id;
            $favorites = Favorite::where('user_id', $user_id)->select('plan_id')->get();
            $response = [];
            foreach ($favorites as $favorite) {
                $response[] = $favorite->plan_id;
            }
            return response()->json([
                // 重複削除してからreturnする
                'items' => array_unique($response)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
