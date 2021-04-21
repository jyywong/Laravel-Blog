<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TopicFilterController extends Controller
{
    public function filter(Board $board,  $filter){
        $topics = Topic::where('board_id', '=', $board->id);
        switch($filter){
            case 'new':
                $filteredTopics = $topics->orderBy('created_at', 'asc')->paginate(5);
                break;
            case 'top':
                // This query is quite hacky. However, I have spend days trying to make a more efficient query that 
                // starts with Topic:: instead of querying posts and then finding the topic related to it. 
                // However, I just can't seem to figure out how to get withCount() to work with the
                // "likes" hasmanyThrough relationship I have on the topics model. So this will have to do.
                $OPs = Post::withCount('likes')
                ->join('topics', 'topics.id', '=', 'posts.topic_id')
                ->where('isOP', true)
                ->where('board_id', $board->id)
                ->orderBy('likes_count', 'desc')
                ->get();

                $filteredTopics = $OPs->map(function($post){
                    return Topic::find($post->topic_id);
                });
                break;
            case 'hot':
                $OPs = Post::withCount('likes')
                ->join('topics', 'topics.id', '=', 'posts.topic_id')
                ->where('isOP', true)
                ->where('board_id', $board->id)
                ->whereBetween('posts.created_at', [Carbon::now()->subDay(), Carbon::now()])
                ->orderBy('likes_count', 'desc')
                ->get();

                $filteredTopics = $OPs->map(function($post){
                    return Topic::find($post->topic_id);
                });
                // ->whereBetween('created_at', [Carbon::now(), Carbon::now()->subDay()])
                break;
        }
        return view('topics/topicList', [
            'topics'=>$filteredTopics ,
            'board'=> $board
        ]);
    }
}
