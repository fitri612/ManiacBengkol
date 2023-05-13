<?php

namespace App\Http\Livewire\Cart;

use App\Models\cart as Cart;
use Livewire\Component;

class CartList extends Component
{
    public $cartitems, $sub_total = 0, $total = 0, $tax = 0;
    public function render()
    {
        $this->cartitems = Cart::with('product')
                ->where(['user_id'=>auth()->user()->id])
                ->where('status', '!=', Cart::STATUS['success'])
                ->get();
        $this->total = 0;$this->sub_total = 0; $this->tax = 0;

        foreach($this->cartitems as $item){
            $this->sub_total += $item->product->price * $item->quantity;
        }
        $this->total = $this->sub_total - $this->tax;
        return view('livewire.cart.cart-list');
    }

    public function incrementQty($id){
        $cart = Cart::whereId($id)->first();
        $cart->quantity += 1;
        $cart->save();

        session()->flash('success', 'Product quantity updated !!!');
    }

    public function decrementQty($id){
        $cart = Cart::whereId($id)->first();
        if($cart->quantity > 1){
            $cart->quantity -= 1;
            $cart->save();
            session()->flash('success', 'Product quantity updated !!!');
        }else{
            session()->flash('error','You cannot have less than 1 quantity');
        }
    }

    public function removeItem($id){
        $cart = Cart::whereId($id)->first();

        if($cart){
            $cart->delete();
            $this->emit('updateCartCount');
        }
        session()->flash('success', 'Product removed from cart !!!');
    }
}
