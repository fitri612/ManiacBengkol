<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class Index extends Component
{
    public $categories;
    public $name;
    public $selectedCategory;

    public function mount()
    {
        $this->categories = Category::all();
    }
    
    public function render()
    {
        return view('livewire.category.index');
    }

    public function create()
    {
        # code...
        Category::create(['category_name' => $this->name]);
        $this->reset('name');
        $this->categories = Category::all();
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $this->selectedCategory = $category;
        $this->name = $category->name;
    }

    public function update()
    {
        $this->selectedCategory->update(['category_name' => $this->name]);
        $this->reset('name', 'selectedCategory');
        $this->categories = Category::all();
    }

    
    public function delete($id)
    {
        Category::destroy($id);
        $this->categories = Category::all();
    }
}
