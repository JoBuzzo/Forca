<?php

namespace App\Livewire;

use App\Models\UserWord;
use App\Models\Word;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class RandomWord extends Component
{
    public function render()
    {
        return view('livewire.random-word')->layout('layouts.app');
    }


    public $txt = '';
    public $users;
    public function mount()
    {
        $this->users = DB::table('user_word')
            ->selectRaw('users.name as name, user_word.user_id, SUM(user_word.score) as total_score, COUNT(DISTINCT user_word.word_id) as word_count')
            ->where('user_word.finalized', true)
            ->join('users', 'users.id', '=', 'user_word.user_id')
            ->groupBy('user_word.user_id', 'users.name')
            ->orderByDesc('total_score')
            ->limit(10)
            ->get();

        if (Session::get('word_id')) {
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

        if (!$words_without_relation->isEmpty()) {
            Session::put('word_id', $words_without_relation->random()->id);
            return redirect()->route('game');

        } else if (
            $word_id = DB::table('user_word')
            ->where('user_id', $user->id)
            ->where('finalized', false)
            ->first()?->word_id
        ) {
            DB::table('user_word')
                ->where('user_id', $user->id)
                ->where('word_id', $word_id)
                ->delete();

            Session::put('word_id', $word_id);
            return redirect()->route('game');
        } else {
            $this->txt = "Sem palavras disponíveis.";
        }
    }
}
