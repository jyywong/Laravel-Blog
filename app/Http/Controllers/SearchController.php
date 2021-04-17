<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        $results = Topic::with('board')
        ->where('topic', 'ilike', "%{$request->input('q')}%")
        ->paginate(5);

        $query = $request->input('q');

        $context = [
            'query' => $query,
            'results' => $results
        ];
        return view('search.searchResults', $context);
    }
}
