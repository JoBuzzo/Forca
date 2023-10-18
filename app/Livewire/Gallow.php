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
    public function mount()
    {
        $content = file_get_contents(storage_path('app/public/substantivos.txt'));
        $words = explode(PHP_EOL, $content);

        $this->word = $words[rand(0, count($words))];

        $this->wordArr = preg_split("/(?<!^)(?!$)/u", $this->word);

        $this->lifes = 6;

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

            dd("Ganhou", $this->word); //Modal win
        } else if (GallowService::finishedLost($this->lifes)) {

            dd("Perdeu", $this->word); //Modal lost
        }

        return view('livewire.gallow');
    }
    public function verifyLetter($letter)
    {
        if (!in_array($letter, $this->correctLetters) && ! in_array($letter, $this->errorLetters)) {
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
}
