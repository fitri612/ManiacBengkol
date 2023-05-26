<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Str;
use App\Models\cart as Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

    public $payment_method, $uuid;
    protected $rules = [
        'payment_method' => 'not_in:Choose payment method',
    ];
    public function checkout(){
        try {
            DB::beginTransaction();
            $this->cartitems = Cart::with('product')
            ->where(['user_id'=>auth()->user()->id])
            ->where('status', '!=', Cart::STATUS['success'])
            ->get();
            // dd($this->cartitems);

            $this->total = 0;
            $this->sub_total = 0; 
            $this->tax = 0;
            foreach($this->cartitems as $item){
                $this->sub_total += $item->product->price * $item->quantity;
            }
            $uuid = Str::uuid();

            $transaction = Transaction::create([
                'user_id' => auth()->user()->id,
                'code_invoice' => $uuid,
                'grand_total' => $this->sub_total,
                'transaction_status' => 'pending',
                'method_payment' => $this->payment_method,
            ]);

            session()->flash('success', 'checkout success !!!');

            // $this->cartitems = Cart::with('product')
            // ->where(['user_id'=>auth()->user()->id])
            // ->where('status', '!=', Cart::STATUS['success'])
            // ->get();
            // foreach ($carts as $cart) {
            //     $product = Product::where('id', $cart->product_id)->first(['id', 'category_id', 'name', 'image', 'description', 'stock', 'price', 'stock']);

            //     TransactionDetail::create([
            //         'transaction_id' => $transaction->id,
            //         'product' => $product,
            //         'qty' => $cart->quantity,
            //         'price' => $product->price,
            //     ]);

            //     $current_stock = $product->stock - $cart->quantity;
            //     $product->update([
            //         'stock' => $current_stock
            //     ]);

            //     $cart->delete();
            // }

            // dd($transaction);
            DB::commit();
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }    
    // public function checkout($id){
    //     try {
    //         DB::beginTransaction();
    //         $user = Auth::user();
    //         $carts = Cart::where('user_id', $user->id)->get();
    //         $total = 0;
    //         foreach ($carts as $cart) {
    //             $total += (int) $cart->product->price * (int) $cart->quantity;
    //         }

    //         $uuid = Str::uuid();

    //         $transaction = Transaction::create([
    //             'user_id' => auth()->user()->id,
    //             'code_invoice' => $uuid,
    //             'grand_total' => $total,
    //             'transaction_status' => 'pending'
    //         ]);

    //         foreach ($carts as $cart) {
    //             $product = Product::where('id', $cart->product_id)->first(['id', 'category_id', 'name', 'image', 'description', 'stock', 'price', 'stock']);

    //             TransactionDetail::create([
    //                 'transaction_id' => $transaction->id,
    //                 'product' => $product,
    //                 'qty' => $cart->quantity,
    //                 'price' => $product->price,
    //             ]);

    //             $current_stock = $product->stock - $cart->quantity;
    //             $product->update([
    //                 'stock' => $current_stock
    //             ]);

    //             $cart->delete();
    //         }

    //         // dd($transaction);
    //         DB::commit();
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    // }    
}
