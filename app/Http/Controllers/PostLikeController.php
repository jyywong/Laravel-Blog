<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function like(Request $request, Board $board, Topic $topic, Post $post)
    {
        $post->likes()->create([
            'user_id'=>$request->user()->id
        
        ]);
        return back();
    }
    public function unlike(Request $request,Board $board, Topic $topic, Post $post)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}

