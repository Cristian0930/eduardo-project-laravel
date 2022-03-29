<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Asset;

class ShowAssets extends Component
{
    public $search;
    public $sort = 'serial_number';
    public $direction = 'desc';
    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $assets = Asset::where('serial_number', 'like', '%' . $this->search . '%')
            ->orWhere('brand', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->get();

        return view('livewire.show-assets', compact('assets'));
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
}
