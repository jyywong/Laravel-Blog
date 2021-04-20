<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Topic;
use App\Models\Post;
use App\Notifications\HasRepliedToYou;

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

        $posts = null;
        $context = [
            'board'=>$board,
            'topic'=>$topic,
            'OP'=>$originalPost,
            'posts'=>$posts,
            'replyPost'=>$replyPost
        ];

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
        

        
        return view('posts.postReply', $context);
    }
    public function post(Request $request, Board $board, Topic $topic, Post $post){
        $this->validate($request, [
            'postBody'=>'required'
        ]);
        $postBody = strip_tags($request->postBody);

        $postCreated = Post::create([
            'title'=>'Default title',
            'body' => $postBody,
            'user_id'=> $request->user()->id,
            'topic_id'=>$topic->id,
            'isOP'=> false,
            'replying_to_id'=>$post->id
        ]);

        if($postCreated){
            $post->user->notify(new HasRepliedToYou($post, $request->user()));
        }

        return redirect()->route('posts', [$board, $topic]);
    }
}
