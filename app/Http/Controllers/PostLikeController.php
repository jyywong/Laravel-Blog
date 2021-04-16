<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Post;
use App\Models\Topic;
use App\Models\Like;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function like(Request $request, Board $board, Topic $topic, Post $post)
    {   
        $user = $request->user()->id;
        $like = Like:: where('user_id', $user)->where('post_id', $post->id);

        if($like->count()){
            if($like->first()->vote_type == 'up'){
                $like->first()->delete();

            }else{
                $like->first()->delete();
                $post->likes()->create([
                    'user_id'=>$user,
                    'vote_type' => 'up'
                ]);
            }
        }else{
            $post->likes()->create([
                'user_id'=>$user,
                'vote_type' => 'up'
            
            ]);
        }
        
        return back();
    }
    public function dislike(Request $request,Board $board, Topic $topic, Post $post)
    {
        $user = $request->user()->id;
        $like = Like:: where('user_id', $user)->where('post_id', $post->id);

       if($like->count()){
            if($like->first()->vote_type == 'down'){
                $like->first()->delete();
                
            }else{
                $like->first()->delete();
                $post->likes()->create([
                    'user_id'=>$user,
                    'vote_type' => 'down'
                ]);
            }
        }else{
            $post->likes()->create([
                'user_id'=>$user,
                'vote_type' => 'down'
            
            ]);
        }
        return back();
    }
}

