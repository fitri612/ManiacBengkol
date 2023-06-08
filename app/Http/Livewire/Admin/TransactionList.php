<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class TransactionList extends Component
{
    public $getdata, $selectedID;
    public $transactionDetail, $grandTotal;
    public $transactionId;
    public $selectedStatus = [];
    public $statusFilter = 'all';
    

    public $status = [
        'Pending',
        'Done',
        'Rejected'
    ];


    public function mount()
    {
        if (Auth::check() && !Auth::user()->is_admin) {
            $userId = Auth::id();
    
            $this->getdata = Transaction::where('users.id', $userId)
                ->join('users', 'transactions.user_id', '=', 'users.id')
                ->select('transactions.*', 'users.name')
                ->get();

        } else {
            $this->getdata = Transaction::join('users', 'transactions.user_id', '=', 'users.id')
                ->select('transactions.*', 'users.name')
                ->get();
        }
       
        
    }
    public function render()
    {
        $query = Transaction::join('users', 'transactions.user_id', '=', 'users.id')
        ->select('transactions.*', 'users.name');

        //filter
        if ($this->statusFilter !== 'all') {
            $query->where('transactions.transaction_status', $this->statusFilter);
        }

        $this->getdata = $query->get();

        return view('livewire.admin.transaction-list', [
            'transactions' => $this->getdata,
            'grandTotal' => $this->grandTotal,
        ]);
    }

    public function showdata($transactionId)
    {
        
        $this->transactionDetail = TransactionDetail::where('transaction_id', $transactionId)
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->select('transaction_details.*', 'products.image','products.name')
            ->get();
        // dd($this->transactionDetail);
        $this->grandTotal = Transaction::where('id', $transactionId)->value('grand_total');

        
    }


    

    public function updateStatus($id)
    {
        $transaction = Transaction::find($id);
       
        if ($transaction) {
            $transaction->transaction_status = $this->selectedStatus[$id];
            $transaction->save();
            session()->flash('success', 'Status updated successfully!');
            // $this->emit('statusUpdated', $id, $this->selectedStatus);
            
        } else {
            session()->flash('error', 'Transaction not found.');
        }
        
        
        // $this->render();
    }

    

    
}
