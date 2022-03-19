<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Asset;

class ShowAssets extends Component
{
    public $search;

    public function render()
    {
        $assets = Asset::where('serial_number', 'like', '%' . $this->search . '%')
            ->orWhere('brand', 'like', '%' . $this->search . '%')
            ->get();

        return view('livewire.show-assets', compact('assets'));
    }
}
