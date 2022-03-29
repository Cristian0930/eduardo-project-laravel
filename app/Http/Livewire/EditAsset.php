<?php

namespace App\Http\Livewire;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Status;
use Livewire\Component;

class EditAsset extends Component
{
    public $open = false;
    public $asset;

    protected array $rules = [
        'asset.serial_number' => 'required|max:255',
        'asset.brand' => 'required|max:255',
        'asset.model' => 'required|max:255',
        'asset.type' => 'required|max:255',
        'asset.category_id' => 'required|numeric',
        'asset.status_id' => 'required|numeric',
        'asset.explanation' => 'required',
        'asset.date_of_entry' => 'required',
        'asset.quantity' => 'required|numeric'
    ];

    public function mount(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function render()
    {
        $categories = Category::all();
        $statuses = Status::all();
        return view('livewire.edit-asset', compact('categories', 'statuses'));
    }

    public function update()
    {
        $this->validate();
        $this->asset->save();

        $this->reset(['open']);

        $this->emitTo('show-assets','render');
        $this->emit('alert', 'the asset was successfully updated');
    }
}
