<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateCategory extends Component
{
    public $open = false;
    public $name;

    protected $rules = [
        'name' => 'required|max:255'
    ];

    public function render()
    {
        return view('livewire.create-category');
    }

    public function save()
    {
        $this->validate();
        Category::create([
            'name' => $this->name,
        ]);

        $user = auth()->user()->name;

        Log::notice('Fue creada una nueva categoría con nombre: ' . $this->name . ' por el usuario: ' . $user);

        $this->reset(['open', 'name']);

        $this->emitTo('show-categories','render');
        $this->emit('alert', 'the asset was successfully created');
    }
}
