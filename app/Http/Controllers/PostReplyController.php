<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Topic;
use App\Models\Post;


class PostReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Board $board, Topic $topic, Post $post){
        $replyPost = $post;
        $originalPost = Post::where('topic_id', '=', $topic->id)
        ->first();
        // Need to implement eager loading. Lots of queries are being wasted.
        $posts = null;
        $context = [
            'board'=>$board,
            'topic'=>$topic,
            'OP'=>$originalPost,
            'posts'=>$posts,
            'replyPost'=>$replyPost
        ];

        // A topic without a post creates an error. However, a topic should not exist without a post anyway
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
        
       

        // $posts = Post::with(['user' => function($query) use($originalPost, $topic){
        //     $query->where('topic_id', '=', $topic->id)
        //     ->where('id','!=', $originalPost->id);
        // }])->get();

        
        return view('posts.postReply', $context);
    }
    public function post(Request $request, Board $board, Topic $topic, Post $post){
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
            'replying_to_id'=>$post->id

        ]);
        return redirect()->route('posts', [$board, $topic]);
    }
}
