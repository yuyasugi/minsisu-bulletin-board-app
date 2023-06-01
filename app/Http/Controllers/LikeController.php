<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request){

        $likes = $request->all();
        // dd($likes);
        $like = Like::insert(['user_id' => \Auth::id(), 'post_id' => $likes['post_id']]);

        if($like){
            $messageKey = 'successMessage';
            $flashMessage = 'いいねしました！';
        } else {
            $messageKey = 'errorMessage';
            $flashMessage = 'いいね出来ませんでした。';
        }

        return redirect()->route('index')->with($messageKey, $flashMessage);
    }

    public function destroy(Request $request){

        $likes = $request->all();
        // dd($likes);
        $like = Like::where('post_id', $likes['post_id'])->where('user_id', \Auth::id())->update(['deleted_at' => date("Y-m-d H:i:s", time())]);

        if($like){
            $messageKey = 'successMessage';
            $flashMessage = 'いいねを削除しました。';
        } else {
            $messageKey = 'errorMessage';
            $flashMessage = 'いいねを削除出来ませんでした。';
        }

        return redirect()->route('index')->with($messageKey, $flashMessage);
    }
}
