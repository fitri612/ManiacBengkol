<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    public  $name, $price, $description, $image, $stock, $category_id;
    public $selectedProduct;
    public  $categories;
    public $products;

    public function mount()
    {
        $this->products = Product::all();
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.product.index',[
            'products ' => Product::paginate(10),
        ]);
    }

    protected $rules = [
        'name' => 'required|unique:products,name',
        'price' => 'required|numeric',
        'description' => 'required',
        'image' => 'required|image|max:1024',
        'category_id' => 'exists:categories,id',
        'stock' => 'required|numeric',
    ];
    // .

    public function store()
    {
       
        $validatedData = $this->validate();

        $validatedData['image'] = $this->image->store('products', 'public');
        
        Product::create($validatedData);
        $this->reset();
        $this->products = Product::all();
        $this->categories = Category::all();
        session()->flash('message', 'Product created successfully!');

       
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $this->selectedProduct = $product;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->image = $product->image;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
    }

    public function update()
    {
        $this->selectedProduct->update(['name' => $this->name]);
        $this->reset('name', 'selectedProduct');
        $this->products = Product::all();
        $this->reset(['selectedProduct', 'name']);
        session()->flash('message', 'Product Update successfully!');
    }

    
    public function delete($id)
    {
        Product::destroy($id);
        session()->flash('message', 'Product Delete successfully!');
        
    }


}
