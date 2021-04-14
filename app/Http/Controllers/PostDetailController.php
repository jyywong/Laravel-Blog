<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostDetailController extends Controller
{
    public function index(Post $post){
        return view('posts.postDetail', [
            'post'=>$post
        ]);
    }
}
