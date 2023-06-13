<?php

namespace App\Http\Livewire\Cart;

use App\Models\cart;
use App\Models\Product;

use Livewire\Component;

class Index extends Component
{
    public $products;
    public $selectedProduct;
    public function render()
    {
        $this->products = Product::get();
        return view('livewire.cart.index');
        // aa
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

    public function getProduct($id)
    {
        $products = Product::find($id);

        if ($products) {
            $this->selectedProduct = $products;
        }
        // $this->emit('productSelected', $id);
        // session()->flash('success', 'click Product successfully '. $id);
    }
}