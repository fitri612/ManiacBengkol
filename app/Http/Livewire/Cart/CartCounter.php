<?php

namespace App\Http\Livewire\Cart;

use App\Models\cart;
use Livewire\Component;

class CartCounter extends Component
{
    public $total = 0;

    protected $listeners = ['updateCartCount' => 'getCartItemCount'];
    public function render()
    {
        $this->getCartItemCount();
        return view('livewire.cart.cart-counter');
    }

    public function getCartItemCount(){
        $this->total = cart::whereUserId(auth()->user()->id)
            ->where('status', '!=', cart::STATUS['success'])
            ->count();
    }
}
