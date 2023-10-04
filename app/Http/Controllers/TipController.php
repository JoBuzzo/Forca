<?php

namespace App\Http\Controllers;

use App\Models\Tip;
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


    public function edit(string $id)
    {
        if (!$tip = Tip::find($id)) {
            return redirect()->back();
        }

        return view('tip.edit', ['tip' => $tip]);
    }

    public function update(Request $request, string $id)
    {
        if (!$tip = Tip::find($id)) {
            return redirect()->back();
        }

        $request->validate([
            'tip' => ['required', 'min:5', 'max:60'],
        ]);

        $tip->update([
            'tip' => $request->tip
        ]);


        return redirect()->route('tip.edit', $tip->id);
    }


    public function destroy(string $id)
    {
        if (!$tip = Tip::find($id)) {
            return redirect()->back();
        }

        $wordId = $tip->word->id;
        $tip->delete();

        return redirect()->route('word.edit', $wordId);
    }
}
