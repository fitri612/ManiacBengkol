<?php

namespace App\Http\Livewire\Transaction;

use App\Models\Cart;
use App\Models\Product;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;


class Transaction extends Component
{
    public function render()
    {
        return view('livewire.transaction.transaction');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $carts = Cart::where('user_id', $user->id)->get();
            $total = 0;
            foreach ($carts as $cart) {
                $total += (int) $cart->product->price * (int) $cart->quantity;
            }

            $uuid = Str::uuid();

            $transaction = Transaction::create([
                'user_id' => auth()->user()->id,
                'code_invoice' => $uuid,
                'grand_total' => $total,
                'transaction_status' => 'pending'
            ]);

            foreach ($carts as $cart) {
                $product = Product::where('id', $cart->product_id)->first(['id', 'category_id', 'name', 'image', 'description', 'stock', 'price', 'stock']);

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product' => $product,
                    'qty' => $cart->quantity,
                    'price' => $product->price,
                ]);

                $current_stock = $product->stock - $cart->quantity;
                $product->update([
                    'stock' => $current_stock
                ]);

                $cart->delete();
            }

            // dd($transaction);
            DB::commit();
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
