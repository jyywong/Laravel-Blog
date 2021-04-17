<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Topic;
use App\Models\Post;
use Illuminate\Http\Request;

class TopicEditorController extends Controller
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

        return view('topics.editTopic', $context);
    }
    public function edit(Request $request, Board $board, Topic $topic){
        $this->validate($request, [
            'topicBody'=>'required'
        ]);
        $post = Post::find($topic->OP()->id);
        $post->body = $request->topicBody;
        $post->save();

        return redirect()->route('posts', [$board, $topic]);
    }
}
