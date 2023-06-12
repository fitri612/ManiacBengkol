<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class TransactionList extends Component
{
    public $showModal = false;
    public $showModalimg = false;

    public $sortField = 'transactions.id'; // Default sort field
    public $sortDirection = 'asc'; // Default sort direction

    public $getdata, $dateFilter;
    public $transactionDetail, $grandTotal, $image;
    public $transactionId, $transaction, $transactionNoteId;
    public $selectedStatus = [];
    public $statusFilter = 'all';

    use WithFileUploads;
    
    public $status = [
        'Pending',
        'Done',
        'Rejected'
    ];

    public function rules()
    {
        return [
            'image' => 'required|image',
        ];
    }

    public function sortBy($field)
    {
        // If the same field is clicked again, reverse the sort direction
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // If a new field is clicked, set the sort field and default to ascending order
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        if ($this->sortField === 'transactions.grand_total') {
            if ($this->sortDirection === 'asc') {
                $this->getdata = $this->getdata->sortBy(function ($item) {
                    return array_sum(str_split($item->grand_total));
                })->values();
            } else {
                $this->getdata = $this->getdata->sortByDesc(function ($item) {
                    return array_sum(str_split($item->grand_total));
                })->values();
            }
        }
    }


    
    public function render()
    {
        $userId = Auth::id();
        $query = Transaction::join('users', 'transactions.user_id', '=', 'users.id')
            ->select('transactions.*', 'users.name');
            if (Auth::check() && !Auth::user()->is_admin) {
                $query->where('users.id', $userId);
            }
            if ($this->statusFilter !== 'all') {
                        $query->where('transactions.transaction_status', $this->statusFilter);
                    }
            
            $query->orderBy($this->sortField, $this->sortDirection);
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
        // $this->grandTotal = Transaction::where('id', $transactionId)->value('grand_total');
        $transaction = Transaction::find($transactionId);
        $this->grandTotal = $transaction->grand_total;
        // $this->createdAt = $transaction->created_at;
        $this->createdAt = Carbon::parse($transaction->created_at)->format('F d, Y \a\t H:i');
        
    }

    public function uploadTransactionNote($transactionNoteId)
    {
        $this->showModalimg = true;
        $this->transactionNoteId = $transactionNoteId;
        $transaction = Transaction::find($this->transactionNoteId);
        if ($transaction && $this->image && $this->image->getSize() > 0) {
            $path = $this->image->store('transaction_note', 'public');
            $transaction->transaction_note = $path;
            $transaction->save();
            session()->flash('success', 'Transaction note uploaded successfully!');
            $this->showModalimg = false;
            
            // $this->dispatchBrowserEvent('submit-form');
            $this->dispatchBrowserEvent('hide-modal', ['itemId' => $transactionNoteId]);
            $this->image = null;
        }
       
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



    public function openModal($transactionId)
    {
        $this->transactionId = $transactionId;
        $this->transactionDetail = TransactionDetail::where('transaction_id', $transactionId)->get();
        $this->showModal = true;
        $this->transactionDetail = TransactionDetail::where('transaction_id', $transactionId)
        ->join('products', 'transaction_details.product_id', '=', 'products.id')
        ->select('transaction_details.*', 'products.image','products.name')
        ->get();
        $transaction = Transaction::find($transactionId);
        $this->grandTotal = $transaction->grand_total;
        $this->createdAt = Carbon::parse($transaction->created_at)->format('F d, Y \a\t H:i');
    }
    
    public function closeModal()
    {
        $this->showModal = false;
    }
    public function closeModalimg()
    {
        $this->showModalimg = false;
    }



    
}
