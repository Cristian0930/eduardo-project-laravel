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
    public $search = '';
    public $asset;
    public $sort = 'serial_number';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false;

    protected $listeners = ['render' => 'render', 'delete'];

    public $open_edit = false;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'serial_number'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

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
        if ($this->readyToLoad) {
            $categories = Category::all();
            $statuses = Status::all();
            $assets = Asset::where('serial_number', 'like', '%' . $this->search . '%')
                ->orWhere('brand', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $assets = [];
            $categories = [];
            $statuses = [];
        }

        return view('livewire.show-assets', compact('assets', 'categories', 'statuses'));
    }

    public function loadAssets()
    {
        $this->readyToLoad = true;
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

    public function delete($asset)
    {
        $asset = Asset::findOrFail($asset);
        $asset->delete();
        $this->asset = null;
    }
}
