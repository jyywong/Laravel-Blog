<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function topics(){
        return $this->hasMany(Topic::class);
    }
}
