<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{
    public function block(Request $request)
    {
        $block = new Block([
            'user_id' => Auth::id(),
            'block_id' => $request->user_id
        ]);
        $block->save();
        return response('ブロックしました', 200)->header('Content-Type', 'text/plain');
    }

    public function unblock(Request $request)
    {
        $block = Block::where('block_id', $request->user_id)->firstOrFail();
        $block->delete();
        return response('ブロック解除しました', 200)->header('Content-Type', 'text/plain');
    }
}
