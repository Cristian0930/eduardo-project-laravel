<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Status;
use Livewire\Component;
use App\Models\Asset;
use Livewire\WithPagination;

class ShowAssets extends Component
{
    use WithPagination;
    public $search, $asset;
    public $sort = 'serial_number';
    public $direction = 'desc';
    protected $listeners = ['render' => 'render'];

    public $open_edit = false;

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

    public function render()
    {
        $categories = Category::all();
        $statuses = Status::all();
        $assets = Asset::where('serial_number', 'like', '%' . $this->search . '%')
            ->orWhere('brand', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.show-assets', compact('assets', 'categories', 'statuses'));
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


    public function edit(Asset $asset)
    {
        $this->asset = $asset;
        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate();
        $this->asset->save();

        $this->reset(['open_edit']);

        $this->emit('alert', 'the asset was successfully updated');
    }
}
