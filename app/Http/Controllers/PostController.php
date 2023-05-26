<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        $Posts = DB::table('posts')->get();

        return view('post.index',compact('Posts'));
    }

    public function create(){

        return view('post.create');
    }

    public function store(Request $request){

        $posts = $request->all();
        $post = Post::insert(['title' => $posts['title'], 'comment' => $posts['comment'], 'user_id' => \Auth::id()]);

        if($post){
            $messageKey = 'successMessage';
            $flashMessage = '投稿に成功しました！';
        } else {
            $messageKey = 'errorMessage';
            $flashMessage = '投稿に失敗しました。';
        }

        return redirect()->route('index')->with($messageKey, $flashMessage);
    }

    public function show($id){

        $showPosts = DB::table('posts')->where('id', '=', $id)->get();

        return view('post.show',compact('showPosts'));
    }
}
