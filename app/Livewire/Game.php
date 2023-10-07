<?php

namespace App\Livewire;

use App\Models\Word;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Game extends Component
{
    public function render()
    {
        return view('livewire.game')->layout('layouts.app');
    }

    public $arrayWord = array();
    public $correctLetters = array();
    public $errorLetters = array();
    public $tips;
    public $categories;
    public $message;

    public function mount()
    {
        if (!$word = Word::find(Session::get('word_id'))) {
            return redirect()->route('home');
        }

        $this->tips = $word->tips;
        $this->categories = $word->categories;
        $this->arrayWord = str_split($word->word, 1);

        if (in_array('-', $this->arrayWord)) {
            $this->correctLetters[] = '-';
        }

        $this->correctLetters = Session::get('correctLetters') ?: array();
        $this->errorLetters = Session::get('errorLetters') ?: array();
        
        $userWord = DB::table('user_word')
            ->where('user_id', Auth::user()->id)
            ->where('word_id', $word->id)
            ->first();

        if (!$userWord) {
            $userWord = DB::table('user_word')->insertGetId([
                'user_id' => Auth::user()->id,
                'word_id' => $word->id,
            ]);
        }
    }

    public function verifyLetter($letter)
    {

        if (in_array($letter, $this->arrayWord) && !in_array($letter, $this->correctLetters)) {

            $this->correctLetter($letter);

            if (count(array_unique($this->arrayWord)) == count($this->correctLetters)) {
                $this->finished();
            }
        } else if (!in_array($letter, $this->errorLetters)) {
            $this->errorLetter($letter);
        }
    }

    protected function finished()
    {
        $this->message = "<span class='absolute text-green-600 top-28'>Você venceu!</span>";

        DB::table('user_word')
            ->where('user_id', Auth::user()->id)
            ->where('word_id', Session::get('word_id'))
            ->update(['finalized' => true]);


        Session::forget('word_id');
        Session::forget('correctLetters');
        Session::forget('errorLetters');
    }

    protected function correctLetter($letter)
    {
        $this->message = "<span class='absolute text-green-600 top-28'>A letra <strong class='text-4xl font-bold uppercase'>{$letter}</strong> está correta</span>";
        $this->correctLetters[] = $letter;
        Session::put('correctLetters', $this->correctLetters);
    }

    protected function errorLetter($letter)
    {
        DB::table('user_word')
            ->where('user_id', Auth::user()->id)
            ->where('word_id', Session::get('word_id'))
            ->decrement('score', 5);

        $this->message = "<span class='absolute text-red-600 top-28'>A letra <strong class='text-4xl font-bold uppercase'>{$letter}</strong> não existe nesta palavra ou já foi inserida</span>";


        $this->errorLetters[] = $letter;
        Session::put('errorLetters', $this->errorLetters);
    
    }
}
