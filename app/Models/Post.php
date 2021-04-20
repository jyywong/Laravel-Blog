<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'topic_id',
        'isOP',
        'replying_to_id'

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function topic(){
        return $this->belongsTo(Topic::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function totalUpvotes(){
        return ($this->likes->where('vote_type', 'up')->count()) - ($this->likes->where('vote_type', 'down')->count());
    }

}