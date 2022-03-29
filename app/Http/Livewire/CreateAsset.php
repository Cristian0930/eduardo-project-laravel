<?php

namespace App\Http\Livewire;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Status;
use Livewire\Component;

class CreateAsset extends Component
{
    public $open = true;

    public $serial_number, $brand, $model, $type, $category_id, $status_id, $explanation, $date_of_entry, $quantity;

    public function render()
    {
        $categories = Category::all();
        $statuses = Status::all();
        return view('livewire.create-asset', compact('categories', 'statuses'));
    }

    public function save()
    {
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
    }
}
