<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUsers extends Component
{
    use WithPagination;

    public $search = '';
    public $user;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = true;
    protected $listeners = ['render' => 'render', 'delete'];
    public $open_edit = false;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    protected array $rules = [
        'user.isAdmin' => 'required'
    ];

    public function render()
    {
        if ($this->readyToLoad) {

            $users = User::where('id', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);

        } else {

            $users = [];
        }

        return view('livewire.show-users', compact('users'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function edit(User $user)
    {
        $this->user = $user;
        $this->open_edit = true;
    }

    public function loadUsers()
    {
        $this->readyToLoad = true;
    }

    public function update()
    {
        try {
            $this->validate();
            $this->user->save();

            $this->reset(['open_edit']);

            $user = auth()->user()->name;

            $this->emit('alert', 'the user was successfully updated');
            Log::info('El usuario con nombre: ' . $this->user->name . ' fue actualizado por el usuario: ' . $user);

        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }

    public function delete($user)
    {
        $user = User::findOrFail($user);
        $user_auth = auth()->user()->name;
        Log::alert('El usuario con id: ' . $user->id . ' y nombre: ' . $user->name . ' fue borrado por: ' . $user_auth);
        $user->delete();
        $this->user = null;
    }
}
