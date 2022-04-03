<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class ShowStatuses extends Component
{
    use WithPagination;

    public $search = '';
    public $status;
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
        'status.name' => 'required|max:255'
    ];

    public function render()
    {
        if ($this->readyToLoad) {

            $statuses = Status::where('id', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);

        } else {
            $statuses = [];
        }

        return view('livewire.show-statuses', compact('statuses'));
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

    public function loadCategories()
    {
        $this->readyToLoad = true;
    }

    public function edit(Status $status)
    {
        $this->status = $status;
        $this->open_edit = true;
    }

    public function update()
    {
        try {
            $this->validate();
            $this->status->save();

            $this->reset(['open_edit']);

            $user = auth()->user()->name;

            $this->emit('alert', 'the status was successfully updated');
            Log::info('El estatus con id: ' . $this->status->id . ' fue actualizado por el usuario: ' . $user);

        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }

    public function delete($status)
    {
        $status = Status::findOrFail($status);
        $user = auth()->user()->name;
        Log::alert('El estatus con id: ' . $status->id . ' fue borrado por el usuario: ' . $user);
        $status->delete();
        $this->status = null;
    }
}
