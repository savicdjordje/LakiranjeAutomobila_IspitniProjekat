<?php

namespace App\Livewire\Dashboard;

use App\Models\Bill;
use Livewire\Component;
use Livewire\WithPagination;

class BillIndex extends Component
{
    use WithPagination;

    public $search;
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';

    public $queryString = ['search', 'sortField', 'sortDirection'];

    public $confirmingDeletion = false;
    public $deletingBill;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDeletion(string $id)
    {
        $this->deletingBill = $id;

        $this->confirmingDeletion = true;
    }

    public function delete(Bill $bill)
    {
        $bill->delete();

        $this->confirmingDeletion = false;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection =
                $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(5);
    }

    public function getRowsQueryProperty()
    {
        return Bill::query()
            ->orderBy($this->sortField, $this->sortDirection)
            ->where('created_at', 'like', "%{$this->search}%");
    }

    public function render()
    {
        return view('livewire.dashboard.bills.index', [
            'bills' => $this->rows,
        ]);
    }
}
