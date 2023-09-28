<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function index()
    {
        $words = Word::paginate(5);

        return view('word.index', [
            'words' => $words,
            
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'word' => ['required', 'min:5', 'max:30'],
            'category' => ['required'],
        ]);
        
        $word = Word::Create([
            'word' => $request->word
        ]);

        $word->categories()->sync($request->category);

        return redirect()->route('word.index');
    }
}
