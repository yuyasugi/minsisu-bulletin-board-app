<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create($id){

        $showPosts = Post::with('comments')
                ->with('user')
                ->where('id', '=', $id)
                ->get();

        return view('comment.create',compact('showPosts'));
    }

    public function store(Request $request){

        $posts = $request->all();
        // dd($posts);
        $comment = Comment::insert(['user_id' => \Auth::id(), 'post_id' => $posts['post_id'], 'comment' => $posts['comment']]);

        if($comment){
            $messageKey = 'successMessage';
            $flashMessage = '返信しました！';
        } else {
            $messageKey = 'errorMessage';
            $flashMessage = '返信に失敗しました。';
        }

        return redirect()->route('index')->with($messageKey, $flashMessage);
    }
}
