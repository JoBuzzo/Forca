<?php

namespace App\Livewire;

use App\Models\Word;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home')->layout('layouts.app');
    }

    public $arrayWord = array();
    public $letters = array();
    public $word;
    public $tips;
    public $categories;
    public $message;
    public function mount()
    {

        $word = Word::get()->last();

        $this->word = $word->word;
        
        $this->tips = $word->tips;

        $this->categories = $word->categories;

        $this->arrayWord = str_split($this->word, 1);
    }

    public function verifyLetter($letter)
    {
        //verifica se a letra informada existe na palavra e se a letra ja foi informada anteriormente
        if(in_array($letter, $this->arrayWord) && !in_array($letter, $this->letters))
        {

            $this->message = "<span class='absolute text-green-600 top-28'>A letra <strong class='text-4xl font-bold uppercase'>{$letter}</strong> está correta</span>";
            $this->letters[] = $letter;

            //caso o valor do array de letras for igual ao outro significa que ele ganhou, pois acertou todas as letras da palavra
            if(count(array_unique($this->arrayWord)) == count($this->letters)){
                dump('voce ganhou');
            }

        }else{
            //perder os pontos
            

            $this->message = "<span class='absolute text-red-600 top-28'>A letra <strong class='text-4xl font-bold uppercase'>{$letter}</strong> não existe nesta palavra ou já foi inserida</span>";

        }


    }


}
