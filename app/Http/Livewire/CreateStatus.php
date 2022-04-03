<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateStatus extends Component
{
    public $open = false;
    public $name;

    protected $rules = [
        'name' => 'required|max:255'
    ];

    public function render()
    {
        return view('livewire.create-status');
    }

    public function save()
    {
        $this->validate();
        Status::create([
            'name' => $this->name,
        ]);

        $user = auth()->user()->name;

        Log::notice('Fue creado un nuevo status con nombre: ' . $this->name . ' por el usuario: ' . $user);

        $this->reset(['open', 'name']);

        $this->emitTo('show-statuses','render');
        $this->emit('alert', 'the status was successfully created');
    }
}
