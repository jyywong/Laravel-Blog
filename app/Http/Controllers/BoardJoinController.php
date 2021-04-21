<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardJoinController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function joinBoard(Request $request, Board $board){
        $targetBoard = Board::find($board->id);
        if($targetBoard->users->contains($request->user()->id)){
            $targetBoard->users()->detach($request->user());
        }
        else{
            $targetBoard->users()->attach($request->user());
        }
        

        return back();
    }
}
