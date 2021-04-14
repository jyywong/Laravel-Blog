<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function listTopics(Board $board){
        $topics = Topic::where('board_id', '=', $board->id)->get();

        return view('topics/topicList', [
            'topics'=> $topics,
            'board'=> $board
        ]);

    }
}
