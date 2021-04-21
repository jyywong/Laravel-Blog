<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = [
        'topic',
        'board_id',
        'OPID'
    ];
    public function board(){
        return $this->belongsTo(Board::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function OP(){
        return $this->posts->where('isOP', true)->first();
    }
    public function getOP(){
        return $this->hasOne(Post::class)->where('topic_id', $this->id)->where('isOP', true);
    }
    public function likes(){
        return $this->hasManyThrough(Like::class, Post::class)->join('topics', 'id', '=', 'posts.topic_id')->where('post_id', 'topics.OPID');
    }

   
    
}
