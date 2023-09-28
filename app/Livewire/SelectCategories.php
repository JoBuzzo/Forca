<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Collection;

class SelectCategories extends Component
{

    public bool $show;

    public $selecteds;
    public function render()
    {
        return view('livewire.select-categories', [
            'categories' => Category::all()
        ]);
    }
    public function mount(Collection $selecteds)
    {
        $this->show = false;
        $this->selecteds = $selecteds;
    }

    public function x_show()
    {
        $this->show = !$this->show;
    }

    public function x_selecteds(Category $category)
    {
        if ($this->selecteds->contains($category)) {
            $index = $this->selecteds->search($category);

            if ($index !== false) {
                $this->selecteds->forget($index);
            }
        } else {
            $this->selecteds->push($category);
        }
    }
}
