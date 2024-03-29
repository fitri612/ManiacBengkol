<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public $categories;
    public $name;
    public $selectedCategory;

    public function mount()
    {
        $this->categories = Category::all();
    }
    
    
    public function render()
    {
        $categories = Category::paginate(10);

        return view('livewire.category.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        # code...
        $validatedData = $this->validate([
            'name' => 'required|unique:categories,category_name',
        ], [
            'name.required' => 'Please enter a category name.',
            'name.unique' => 'This category name already exists.',
        ]);

        Category::create(['category_name' => $this->name]);
        $this->reset('name');
        $this->categories = Category::all();
        session()->flash('message', 'Category created successfully!');
    
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $this->selectedCategory = $category;
        $this->name = $category->category_name;
        
    }

    public function update()
    {
        $this->selectedCategory->update(['category_name' => $this->name]);
        $this->reset('name', 'selectedCategory');
        $this->categories = Category::all();
        $this->reset(['selectedCategory', 'name']);
        session()->flash('message', 'Category Update successfully!');
    }

    
    public function delete($id)
    {
        Category::destroy($id);
        $this->categories = Category::all();
        session()->flash('message', 'Category Delete successfully!');
        
    }
}
