<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class SelectCategories extends Component
{

    public bool $show;

    public $selecteds = [];
    public function render()
    {
        return view('livewire.select-categories', [
            'categories' => Category::all()
        ]);
    }
    public function mount()
    {
        $this->show = false;
    }

    public function x_show()
    {
        $this->show = !$this->show;
    }

    public function x_selecteds(Category $category)
    {
        if (in_array($category, $this->selecteds)) {
            $index = array_search($category, $this->selecteds);
            if ($index !== false) {
                unset($this->selecteds[$index]);
            }
        }else{
            $this->selecteds[] = $category;
        }
    }
}
