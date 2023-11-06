<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCategory extends Component
{
    #[Url] 
    public $search = '';
    use WithPagination;
    public function render()
    {
        if(!$this->search){
            $categories = Category::paginate(5);
        }else{
            $categories = Category::where('description', 'like', "%".$this->search."%")->paginate(5);
        }
        return view('livewire.index-category', ['categories' => $categories]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
