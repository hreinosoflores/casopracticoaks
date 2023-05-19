<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $user_id;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $data = User::
        when($this->search, function($q){
            $q->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('primerApellido', 'like', '%'.$this->search.'%')
            ->orWhere('segundoApellido', 'like', '%'.$this->search.'%')
            ->orWhere('nombreUser', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%');
        })
        ->orderBy('id','DESC')->paginate(12);
        return view('livewire.user-index', compact('data'));
    }
    public function deleteRecord(User $user)
    {
        $user->delete();
        $this->emit('swalDefaultSuccess', 'Registro eliminado correctamente.');
    }
    public function abrirModal($id){
        $this->user_id = $id;
        $user = User::find($id);
        $this->emit('open_modal', 'open_modal');
    }
}
