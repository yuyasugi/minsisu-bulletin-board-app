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

    public function edit($id){

        $editComment = Comment::where('id', '=', $id)->first();

        $showPost = Post::with('comments')
                ->with('user')
                ->find($editComment->post_id);

        return view('comment.edit',compact('editComment', 'showPost'));
    }

    public function update(Request $request){

        $comments = $request->all();
        // dd($comments);
        $updateComment = Comment::where('id', $comments['id'])->update(['comment' => $comments['comment']]);

        if($updateComment){
            $messageKey = 'successMessage';
            $flashMessage = 'コメントの編集が成功しました！';
        } else {
            $messageKey = 'errorMessage';
            $flashMessage = 'コメントの編集できませんでした。';
        }

        return redirect()->route('edit_comment', $comments['id'])->with($messageKey, $flashMessage);
    }
}
