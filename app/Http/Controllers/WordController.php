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
            'word' => ['required', 'min:4', 'max:30'],
            'category' => ['required'],
        ]);
        
        $word = Word::Create([
            'word' => strtolower($request->word)
        ]);

        $word->categories()->sync($request->category);

        return redirect()->route('word.index');
    }

    public function edit(string $id)
    {
        if(!$word = Word::find($id)){
            return redirect()->route('word.index');
        }

        return view('word.edit', ['word' => $word]);
    }


    public function update(Request $request, string $id)
    {
        if(!$word = Word::find($id)){
            return redirect()->route('word.index');
        }

        $request->validate([
            'word' => ['required', 'min:4', 'max:30'],
            'category' => ['required'],
        ]);

        $word->update([
            'word' => strtolower($request->word)
        ]);

        $word->categories()->sync($request->category);

        return redirect()->route('word.edit', $word->id);
    }

    public function destroy(string $id)
    {
        if(!$word = Word::find($id)){
            return redirect()->route('word.index');
        }

        $word->categories()->detach();
        
        $word->tips()->delete();

        $word->delete();

        return redirect()->route('word.index');
    }
}
