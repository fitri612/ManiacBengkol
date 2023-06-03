<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionList extends Component
{
    public $getdata, $selectedID, $selectedStatus;
    

    public $status = [
        'Pending',
        'Done',
        'Rejected'
    ];

    // public function updateData()
    // {
    //     $this->getdata = Transaction::join('users', 'transactions.user_id', '=', 'users.id')
    //         ->select('transactions.*', 'users.name')
    //         ->get();
    // }

    public function mount()
    {
        if (Auth::check() && !Auth::user()->is_admin) {
            $userId = Auth::id();
    
            $this->getdata = Transaction::join('users', 'transactions.user_id', '=', 'users.id')
                ->select('transactions.*', 'users.name')
                ->where('users.id', $userId)
                ->get();
        } else {
            $this->getdata = Transaction::join('users', 'transactions.user_id', '=', 'users.id')
                ->select('transactions.*', 'users.name')
                ->get();
        }
        
    }
    public function render()
    {
        return view('livewire.admin.transaction-list',[
            'transactions' => $this->getdata,
        ]);
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
