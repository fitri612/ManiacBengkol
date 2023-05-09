<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
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
        return view('livewire.product.index');
    }

    protected $rules = [
        'name' => 'required|unique:products,name',
        'price' => 'required|numeric',
        'description' => 'required',
        'image' => 'required|image|max:1024',
        'category_id' => 'exists:categories,id',
        'stock' => 'required|numeric',
    ];

    public function store()
    {
        # code...
        // $validatedData = $this->validate([
        //     'name' => 'required|unique:products,name',
        //     'price' => 'required',
        //     'description' => 'required',
        //     'image' => 'required|image|max:1024',
        //     'category_id' => 'nullable|exists:categories,id',
        //     'stock' => 'required',
        // ], [
        //     'name.required' => 'Please enter a product name.',
        //     'name.unique' => 'This product name already exists.',
        //     'image.required' => 'Please upload an image.',
        //     'image.image' => 'Please upload an image file.',
        //     'image.max' => 'The image must be less than 1 MB.',
        // ]);

        $validatedData = $this->validate();

        $validatedData['image'] = $this->image->store('products', 'public');
        Product::create($validatedData);

        session()->flash('message', 'Product created successfully!');
        $this->reset();

        // if ($this->image) {
        //     $validatedData['image'] = $this->image->store('products', 'public');
        // }

        
        // $product = Product::create($validatedData);

        // session()->flash('message', 'Product created successfully!');
        // $this->reset();
       
    }


}
