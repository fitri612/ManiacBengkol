<?php

namespace App\Http\Livewire\Transaction;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithFileUploads;
use App\Models\TransactionDetail;


class TransactionDtl extends Component
{
    use WithFileUploads;
    
    public $showModal = false;
    public $transaction_detail, $codeInvoice, $product, $totalPrice, $latestTransaction;
    public  $total = 0;
    public $image;

    public function mount()
    {
        $this->loadTransactionDetails();
    }
    
    public function loadTransactionDetails()
    {

        $this->latestTransaction = Transaction::latest('id')->first();
        // if ($this->latestTransaction) {
        //     $this->transaction_detail = TransactionDetail::where('transaction_id', $this->latestTransaction->id)
        //         ->join('products', 'transaction_details.product_id', '=', 'products.id')
        //         // ->select('transaction_details.*', 'products.image','products.name')
        //         ->select('transaction_details.*', 'products.image as product_image', 'products.name as product_name')
        //         ->get();
        if ($this->latestTransaction) {
            $this->transaction_detail = TransactionDetail::with('product')
                ->where('transaction_id', $this->latestTransaction->id)
                ->get();
            // dd($this->transaction_detail);
        } else {
            $this->transaction_detail = collect();
        }

        $latestId = Transaction::latest('id')->value('id');

        if ($latestId) {
            $latestTransaction = Transaction::find($latestId);
            $codeInvoice = $latestTransaction->code_invoice;
            $this->InvoiceCode = $latestTransaction;
        } else {
            $this->InvoiceCode = null;
        }

        $totalQty = $this->transaction_detail->sum('qty');
        $this->totalQty = $totalQty;

        $totalPrice = $this->transaction_detail->sum(function ($transaction_detail) {
            return $transaction_detail->qty * $transaction_detail->price;
        });
        $this->totalPrice = $totalPrice;

       
    }
    public function render()
    {
        // $this->transaction_detail = TransactionDetail::get();
        // $this->products = Product::get();
        // $this->transaction_detail = TransactionDetail::where('transaction_id', auth()->user()->id)
        // ->get();
        // dd($this->transaction_detail);
        return view('livewire.transaction.transaction-dtl');
    }

    public function confirm_payment()
    {
        
        $latestTransaction = Transaction::latest('id')->first();

        if ($latestTransaction) {
            $path = $this->image->store('transaction_note', 'public');

            $latestTransaction->transaction_note = $path;

            $totalPrice = $this->transaction_detail->sum(function ($transaction_detail) {
                return $transaction_detail->qty * $transaction_detail->price;
            });
            
            $latestTransaction->nominal = $totalPrice;
            $latestTransaction->save();
            
            $this->reset(['image']);
        }
        
        session()->flash('success', 'upload payment note success!');
        return redirect('/user-transaction-list');

    }
}
