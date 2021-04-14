<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function listBoards(){
        $boards = Board::all();

        return view('boards.boardList', [
            'boards' => $boards
        ]);

    }
}
