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
    public $chances;

    public $countTips;
    public function mount()
    {
        if (!$word = Word::find(Session::get('word_id'))) {
            return redirect()->route('home');
        }


        $this->countTips = Session::get('countTips') ?: 0;
        $this->tips = $word->tips()->limit($this->countTips)->get();
        $this->categories = $word->categories;
        $this->arrayWord = str_split($word->word, 1);


        $this->correctLetters = Session::get('correctLetters') ?: array();
        $this->errorLetters = Session::get('errorLetters') ?: array();

        if (in_array('-', $this->arrayWord)) {
            $this->correctLetters[] = '-';
        }


        $userWord = DB::table('user_word')
            ->where('user_id', Auth::user()->id)
            ->where('word_id', $word->id)
            ->first();


        if (!$userWord) {
            $userWord = DB::table('user_word')->insert([
                'user_id' => Auth::user()->id,
                'word_id' => $word->id,
                'score' => 10
            ]);
        }
        $this->chances = DB::table('user_word')
            ->where('user_id', Auth::user()->id)
            ->where('word_id', $word->id)
            ->value('score');
    }

    

    //verifica se a letra esta correta, salvando-a no array de letras erradas ou letras corretas
    public function verifyLetter($letter)
    {

        if (in_array($letter, $this->arrayWord) && !in_array($letter, $this->correctLetters)) {

            $this->correctLetter($letter);

            if (count(array_unique($this->arrayWord)) == count($this->correctLetters)) {
                $this->message = "<span class='absolute text-green-600'>Você venceu!</span>";

                $this->finished();
            }
        } else if (!in_array($letter, $this->errorLetters)) {
            $this->errorLetter($letter);
        }
    }

    //dar dica
    public function tip()
    {
        $word = Word::find(Session::get('word_id'));
        if ($word->tips->count() > $this->countTips) {
            if ($this->chances > 2) {
                $this->countTips++;

                Session::put('countTips', $this->countTips);

                DB::table('user_word')
                    ->where('user_id', Auth::user()->id)
                    ->where('word_id', Session::get('word_id'))
                    ->decrement('score', 2);
                $this->chances -= 2;

                $this->tips =  $word->tips()->limit($this->countTips)->get();
            } else {
                $this->message = "<span class='absolute text-sm text-red-600 md:text-base'>Você não possui chances suficientes para usar dicas.</span>";
            }
        } else {
            $this->message = "<span class='absolute text-sm text-red-600 md:text-base'>Esta palavra não possui mais dicas.</span>";
        }
    }
    protected function finished()
    {
        DB::table('user_word')
            ->where('user_id', Auth::user()->id)
            ->where('word_id', Session::get('word_id'))
            ->update(['finalized' => true]);


        Session::forget('word_id');
        Session::forget('correctLetters');
        Session::forget('errorLetters');
        Session::forget('countTips');

        return redirect()->route('home');
    }

    protected function correctLetter($letter)
    {
        $this->message = "<span class='text-sm text-green-600 md:text-base'>A letra <strong class='text-4xl font-bold uppercase'>{$letter}</strong> está correta</span>";
        $this->correctLetters[] = $letter;
        Session::put('correctLetters', $this->correctLetters);
    }

    protected function errorLetter($letter)
    {
        $this->errorLetters[] = $letter;
        Session::put('errorLetters', $this->errorLetters);

        $this->message = "<span class='text-sm text-red-600 md:text-base'>A letra <strong class='text-4xl font-bold uppercase'>{$letter}</strong> não existe nesta palavra ou já foi inserida</span>";

        if (
            ($this->chances =  DB::table('user_word')
            ->where('user_id', Auth::user()->id)
            ->where('word_id', Session::get('word_id'))
            ->value('score')) != 0
        ) {
            DB::table('user_word')
            ->where('user_id', Auth::user()->id)
            ->where('word_id', Session::get('word_id'))
            ->decrement('score', 1);
            $this->chances --;
        } else {

            $this->finished();

            $this->message = "<span class='text-sm text-red-600 md:text-base'><strong>Você Perdeu!</strong> Mas você ainda descobrir palavra só não ganhará pontos. <a href='/' class='hover:underline'>Voltar</a></span>";
        }
    }
}
