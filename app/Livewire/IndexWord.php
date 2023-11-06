<?php

namespace App\Livewire;

use App\Models\Word;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class IndexWord extends Component
{
    #[Url] 
    public $search = '';
    use WithPagination;
    public function render()
    {
        if(!$this->search){
            $word = Word::paginate(5);
        }else{
            $word = Word::where('word', 'like', "%".$this->search."%")->paginate(5);
        }
        return view('livewire.index-word',[
            'words' => $word
        ]);
    }
}
