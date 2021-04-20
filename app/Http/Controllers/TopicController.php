<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\Post;

class TopicController extends Controller
{
    public function listTopics(Board $board){
        $topics = Topic::where('board_id', '=', $board->id)->paginate(5);
        // $OP = Post::where('topic_id', $this->id)->where('isOP', true)->get();
        return view('topics/topicList', [
            'topics'=> $topics,
            'board'=> $board
        ]);
    }

    
    
}
