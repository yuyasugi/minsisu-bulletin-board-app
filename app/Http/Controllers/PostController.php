<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(){
        
        $Posts = DB::table('posts')->get();

        return view('post.index',compact('Posts'));
    }
}
