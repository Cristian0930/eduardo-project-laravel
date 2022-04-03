<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCategories extends Component
{
    use WithPagination;

    public $search = '';
    public $asset;
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
        'category.name' => 'required|max:255'
    ];

    public function render()
    {
        if ($this->readyToLoad) {

            $categories = Category::where('id', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);

        } else {
            $categories = [];
        }

        return view('livewire.show-categories', compact('categories'));
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
}
