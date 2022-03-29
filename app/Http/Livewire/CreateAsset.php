<?php

namespace App\Http\Livewire;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Status;
use Livewire\Component;

class CreateAsset extends Component
{
    public $open = false;

    public $serial_number, $brand, $model, $type, $category_id = 1, $status_id = 1, $explanation, $date_of_entry, $quantity;

    protected $rules = [
        'serial_number' => 'required|max:255',
        'brand' => 'required|max:255',
        'model' => 'required|max:255',
        'type' => 'required|max:255',
        'category_id' => 'required|numeric',
        'status_id' => 'required|numeric',
        'explanation' => 'required',
        'date_of_entry' => 'required',
        'quantity' => 'required|numeric'
    ];

    public function render()
    {
        $categories = Category::all();
        $statuses = Status::all();
        return view('livewire.create-asset', compact('categories', 'statuses'));
    }

    public function save()
    {
        $this->validate();

        Asset::create([
            'serial_number' => $this->serial_number,
            'brand' => $this->brand,
            'model' => $this->model,
            'type' => $this->type,
            'category_id' => $this->category_id,
            'status_id' => $this->status_id,
            'explanation' => $this->explanation,
            'date_of_entry' => $this->date_of_entry,
            'quantity' => $this->quantity
        ]);

        $this->reset(['open', 'serial_number', 'brand', 'model', 'type', 'category_id', 'status_id', 'explanation', 'date_of_entry', 'quantity']);

        $this->emitTo('show-assets','render');
        $this->emit('alert', 'the asset was successfully created');
    }
}
