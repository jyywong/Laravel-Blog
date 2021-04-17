<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Topic;
use App\Models\Post;
use Illuminate\Http\Request;


class TopicDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Board $board, Topic $topic){
        $context = [
            'board' => $board,
            'topic' => $topic,
            'OP' => $topic->OP()
        ];

        return view('topics.deleteTopic', $context);
    }
    public function delete(Request $request, Board $board, Topic $topic){
        $post = Post::find($topic->OP()->id);
        $post->delete();
        $topic = Topic::find($topic->id);
        $topic->delete();

        return redirect()->route('topic', [$board]);
    }
}