<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Topic;

class TopicCreatorController extends Controller
{
    public function index(Board $board){
        $context = [
            'board'=>$board
        ];
        return view('topics.createTopic', $context);
    }

    public function createTopic(Request $request, Board $board){
       $this->validate($request, [
           'topicTopic'=>'required',
           'topicBody'=>'required'
       ]);
       $topicTopic = strip_tags($request->topicTopic);
       $postBody = strip_tags($request->topicBody);

       $newTopic = Topic::create([
           'topic'=>$topicTopic,
           'board_id'=>$board->id
       ]);
       Post::create([
           'title'=>'Default title',
           'body'=> $postBody,
           'user_id'=>$request->user()->id,
           'topic_id'=>$newTopic->id
       ]);
       return redirect()->route('posts', [$board, $newTopic]);
    }
}