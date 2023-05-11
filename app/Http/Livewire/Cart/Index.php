<?php

namespace App\Http\Livewire\Cart;

use App\Models\cart;
use App\Models\Product;

use Livewire\Component;

class Index extends Component
{
    public $products;
    public function render()
    {
        $this->products = Product::get();
        return view('livewire.cart.index');
    }

    public function addToCart($id){
        if(auth()->user()){
            // add to cart
            $data = [
                'user_id' => auth()->user()->id,
                'product_id' => $id,
            ];
            cart::updateOrCreate($data);

            $this->emit('updateCartCount');

            session()->flash('success','Product added to the cart successfully');
        }else{
            // redirect to login page
            return redirect(route('login'));
        }
    }
}
