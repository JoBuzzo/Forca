<?php

namespace App\Livewire;

use App\Models\Word;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

class Game extends Component
{
    #[Layout("layouts.app")]
    public function render()
    {
        return view('livewire.game');
    }

    public $modal = false;
    public $word;
    public $arrayWord = array();
    public $correctLetters = array();
    public $errorLetters = array();
    public $tips;
    public $categories;
    public $message;
    public $chances;
    public $countTips;
    public $victory = true;
    public function mount()
    {
        if (!$this->word = Word::find(Session::get('word_id'))) {
            return redirect()->route('home');
        }


        $this->countTips = Session::get('countTips') ?: 0;
        $this->tips = $this->word->tips()->limit($this->countTips)->get();
        $this->categories = $this->word->categories;
        $this->arrayWord = str_split($this->word->word, 1);


        $this->correctLetters = Session::get('correctLetters') ?: array();
        $this->errorLetters = Session::get('errorLetters') ?: array();

        if (in_array('-', $this->arrayWord)) {
            $this->correctLetters[] = '-';
        }
        if (in_array("'", $this->arrayWord)) {
            $this->correctLetters[] = "'";
        }


        $userWord = DB::table('user_word')
            ->where('user_id', Auth::user()->id)
            ->where('word_id', $this->word->id)
            ->first();


        if (!$userWord) {
            $userWord = DB::table('user_word')->insert([
                'user_id' => Auth::user()->id,
                'word_id' => $this->word->id,
                'score' => 10
            ]);
        }
        $this->chances = DB::table('user_word')
            ->where('user_id', Auth::user()->id)
            ->where('word_id', $this->word->id)
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
        $word = Word::find($this->word->id);
        if ($word->tips->count() > $this->countTips) {
            if ($this->chances > 2) {
                $this->countTips++;

                Session::put('countTips', $this->countTips);

                DB::table('user_word')
                    ->where('user_id', Auth::user()->id)
                    ->where('word_id', $this->word->id)
                    ->decrement('score', 2);
                $this->chances -= 2;

                $this->tips =  $word->tips()->limit($this->countTips)->get();
            } else {
                $this->message = "<span class='text-sm text-red-600 md:text-base'>Você não possui chances suficientes para usar dicas.</span>";
            }
        } else {
            $this->message = "<span class='text-sm text-red-600 md:text-base'>Esta palavra não possui mais dicas.</span>";
        }
    }
    public function finished()
    {
        DB::table('user_word')
            ->where('user_id', Auth::user()->id)
            ->where('word_id', $this->word->id)
            ->update(['finalized' => true]);


        Session::forget('word_id');
        Session::forget('correctLetters');
        Session::forget('errorLetters');
        Session::forget('countTips');

        $this->modal = true;
    }

    protected function correctLetter($letter)
    {
        $this->message = "<span class='text-sm text-green-600 md:text-base'>A letra <strong class='font-bold uppercase'>{$letter}</strong> está correta</span>";
        $this->correctLetters[] = $letter;
        Session::put('correctLetters', $this->correctLetters);
    }

    protected function errorLetter($letter)
    {
        $this->errorLetters[] = $letter;
        Session::put('errorLetters', $this->errorLetters);

        $this->message = "<span class='text-sm text-red-600 md:text-base'>A letra <strong class='font-bold uppercase'>{$letter}</strong> não existe nesta palavra ou já foi inserida</span>";

        if (
            ($this->chances =  DB::table('user_word')
                ->where('user_id', Auth::user()->id)
                ->where('word_id', $this->word->id)
                ->value('score')) != 0
        ) {
            DB::table('user_word')
                ->where('user_id', Auth::user()->id)
                ->where('word_id', $this->word->id)
                ->decrement('score', 1);
            $this->chances--;
        } else {
            $this->message = "<span class='text-sm text-red-600 md:text-base'><strong>Você Perdeu!</strong> Mas você ainda descobrir palavra só não ganhará pontos. <a wire:click='finished' class='cursor-auto hover:underline'>Voltar</a></span>";
            $this->victory = false;
        }
    }


 
    #[Rule([
        'key' => ['required', 'min:1', 'max:1']
    ], attribute: [
        'key' => 'letra',
    ])]
    public $key = '';
    public function handleKeyDown()
    {
        $this->key = Str::lower(str_replace(' ', '-', Str::ascii($this->key)));

        if(strlen($this->key) == 1 ){
            $this->verifyLetter($this->key);
        }

        $this->reset('key');

        // dd($this->key);
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
            return redirect()->route('home');
        }
    }
}
