<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Topic;

class PostController extends Controller
{
    public function index(Board $board, Topic $topic){
        $originalPost = Post::where('topic_id', '=', $topic->id)
        ->first();
        // Need to implement eager loading. Lots of queries are being wasted.
        $posts = null;
        $context = [
            'board'=>$board,
            'topic'=>$topic,
            'OP'=>$originalPost,
            'posts'=>$posts
        ];

        // A topic without a post creates an error. However, a topic should not exist without a post anyway
        if($originalPost){
            if(Post::where('topic_id', '=', $topic->id)
            ->where('id','!=', $originalPost->id)
            ->get()
            ->count() >= 1 )
                {     
                $posts = Post::with('user')->where('topic_id', '=', $topic->id)
                ->where('id','!=', $originalPost->id)
                ->get();
                $context['posts'] = $posts;
                }
        }
        
        

        
        return view('posts.posts', $context);
    }

    public function post(Request $request, Board $board, Topic $topic){
        $originalPost = Post::where('topic_id', '=', $topic->id)->where('isOP', true)->first();
        $this->validate($request, [
            'postBody'=>'required'
        ]);
        $postBody = strip_tags($request->postBody);
        
        Post::create([
            'title'=>'Default title',
            'body' => $postBody,
            'user_id'=> $request->user()->id,
            'topic_id'=>$topic->id,
            'isOP'=> false,
            'replying_to_id'=>$originalPost->id

        ]);
        return back();
    }
}
