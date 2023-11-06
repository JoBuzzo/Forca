<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class IndexUser extends Component
{
    #[Url] 
    public $search = '';
    use WithPagination;
    public function render()
    {
        if(!$this->search){
            $users = User::paginate(5);
        }else{
            $users = User::where('name', 'like', "%".$this->search."%")
            ->orWhere('email', 'like', "%".$this->search."%")
            ->paginate(5);
        }
        return view('livewire.index-user', [
            'users' => $users,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
