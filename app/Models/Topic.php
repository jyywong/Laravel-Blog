<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = [
        'topic',
        'board_id'

    ];
    public function board(){
        return $this->belongsTo(Board::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
   
        
}
