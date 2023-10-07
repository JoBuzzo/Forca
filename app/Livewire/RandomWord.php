<?php

namespace App\Livewire;

use App\Models\Word;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class RandomWord extends Component
{
    public function render()
    {
        return view('livewire.random-word')->layout('layouts.app');
    }



    public function mount()
    {
        if(Session::get('word_id')){
            return redirect()->route('game');
        }
    }
    public function random()
    {
        $user = Auth::user();

        $words = Word::all();

        $words_without_relation = $words->filter(function (Word $word) use ($user) {
            return !$word->users->contains($user);
        });

        Session::put('word_id', $words_without_relation->random()->id);

        return redirect()->route('game');
    }
}
