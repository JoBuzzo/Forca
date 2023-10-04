<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class TipController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tip' => ['required', 'min:5', 'max:60'],
            'id' => ['exists:words,id'],
        ]);


        $word = Word::find($request->id);

        $word->tips()->create([
            'tip' => $request->tip
        ]);

        return redirect()->route('word.edit', $word->id);
    }
}
