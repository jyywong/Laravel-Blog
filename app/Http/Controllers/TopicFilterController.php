<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicFilterController extends Controller
{
    public function filter(Board $board,  $filter){
        $topics = Topic::where('board_id', '=', $board->id);
        switch($filter){
            case 'hot':
                // $filteredTopics = $topics->where()
                break;
            case 'new':
                $filteredTopics = $topics->orderBy('created_at', 'asc')->paginate(5);
                break;
            case 'top':
                // $filteredTopics = Topic::join('posts', 'topic.id', '=', 'posts.topic_id')
                //                         ->join('likes', 'posts.id', '=', 'likes.post_id'
                $filteredT
                break;
        }
        return view('topics/topicList', [
            'topics'=> $filteredTopics,
            'board'=> $board
        ]);
    }
}
