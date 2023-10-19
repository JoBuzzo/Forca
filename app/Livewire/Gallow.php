<?php

namespace App\Livewire;

use App\Services\GallowService;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Gallow extends Component
{
    public string $word;
    public $wordArr = array();
    public int $lifes;
    public $correctLetters = array();
    public $errorLetters = array();
    public $modal = false;
    public $win;
    public function mount()
    {
        $content = file_get_contents(storage_path('app/public/substantivos.txt'));
        $words = explode(PHP_EOL, $content);

        $this->word = $words[rand(0, count($words))];

        $this->wordArr = preg_split("/(?<!^)(?!$)/u", $this->word);

        $this->lifes = 10;

        if (in_array('-', $this->wordArr)) {
            $this->correctLetters[] = '-';
        }
        if (in_array("'", $this->wordArr)) {
            $this->correctLetters[] = "'";
        }
    }

    #[Layout("layouts.app")]
    public function render()
    {
        if (GallowService::finishedWin($this->wordArr, $this->correctLetters)) {
            $this->modal = true;
            $this->win = true;
        } else if (GallowService::finishedLost($this->lifes)) {
            $this->modal = true;
            $this->win = false;
        }

        return view('livewire.gallow');
    }
    public function verifyLetter($letter)
    {
        if (!in_array($letter, $this->correctLetters) && !in_array($letter, $this->errorLetters)) {
            GallowService::checkLetterInWord($letter, $this->wordArr, $this->correctLetters, $this->errorLetters, $this->lifes);
        }
    }

    #[Rule(['key' => ['required', 'min:1', 'max:1']], attribute: ['key' => 'letra'])]
    public $key = '';
    public function handleKeyDown()
    {
        $this->key = Str::lower(str_replace(' ', '-', Str::ascii($this->key)));

        if (strlen($this->key) == 1) {
            $this->verifyLetter($this->key);
        }

        $this->reset('key');
    }

    public $countTips = 0;
    public function tip()
    {
        if($this->countTips <  3){
            if((count($this->wordArr) - count($this->correctLetters)) > 3 ){
                GallowService::tip($this->wordArr, $this->correctLetters);
                $this->countTips ++;
            }else{
                dd("Não pode dar dicas faltando apenas 3 letras");
            }
        }else {
            dd("Você ja pediu muitas dicas");
        }
    }
}
