<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Transaction;

class TransactionList extends Component
{
    public $getdata, $selectedID, $selectedStatus;
    public $status = [
        'Pending',
        'Done',
        'Rejected'
    ];
    public function mount()
    {
        // $this->getdata = Transaction::get();
        $this->getdata = Transaction::join('users', 'transactions.user_id', '=', 'users.id')
        ->select('transactions.*', 'users.name')
        ->get();
        
    }
    public function render()
    {
        return view('livewire.admin.transaction-list',[
            'transactions' => $this->getdata,
        ]);
    }

    // public function GetID($id)
    // {
    //     $getdata = Transaction::find($id);
    //     if ($getdata) {
    //         $this->selectedID = $getdata;
    //         $this->selectedStatus = $getdata->transaction_status;
    //     }
    //     // session()->flash('success', 'transaction id');

    // }

    public function updateStatus($id)
    {
        $transaction = Transaction::find($id);

        if ($transaction) {
            $transaction->transaction_status = $this->selectedStatus;
            $transaction->save();
            session()->flash('success', 'Status updated successfully!');
            $this->emit('statusUpdated', $id, $this->selectedStatus);
        } else {
            session()->flash('error', 'Transaction not found.');
        }
        $this->render();
    }

    
}
