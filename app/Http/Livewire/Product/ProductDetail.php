<?php

namespace App\Http\Livewire\Product;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class ProductDetail extends Component
{
    public  $categories;
    public $products;
    public $selectedProduct;

    // protected $listeners = ['productSelected'];
    public function mount()
    {
        $this->products = Product::all();
        $this->categories = Category::all();
    }
    public function render()
    {
        return view('livewire.product.product-detail',[
        'selectedProduct' => $this->selectedProduct,
        'products' => $this->products,
        ]);
    }

    public function addToCart($id){
        if (auth()->user()) {
            // Add to cart
            $data = [
                'user_id' => auth()->user()->id,
                'product_id' => $id,
            ];
    
            $cartItem = Cart::where($data)->first();
    
            if ($cartItem) {
                $cartItem->increment('quantity');
            } else {
                Cart::create($data);
            }
    
            $this->emit('updateCartCount');
    
            session()->flash('success', 'Product added to the cart successfully');
        } else {
            
            return redirect(route('login'));
        }
    }

    public function BackToList()
    {
        $this->selectedProduct = null;
    }
   
}
