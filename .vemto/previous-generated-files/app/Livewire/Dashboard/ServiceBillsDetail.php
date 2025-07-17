<?php

namespace App\Livewire\Dashboard;

use Livewire\Form;
use App\Models\Bill;
use Livewire\Component;
use App\Models\Service;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Dashboard\Bills\Forms\CreateDetailForm;
use App\Livewire\Dashboard\Bills\Forms\UpdateDetailForm;

class ServiceBillsDetail extends Component
{
    use WithFileUploads, WithPagination;

    public CreateDetailForm|UpdateDetailForm $form;

    public ?Bill $bill;
    public Service $service;

    public $showingModal = false;

    public $detailBillsSearch = '';
    public $detailBillsSortField = 'updated_at';
    public $detailBillsSortDirection = 'desc';

    public $queryString = [
        'detailBillsSearch',
        'detailBillsSortField',
        'detailBillsSortDirection',
    ];

    public $confirmingBillDeletion = false;
    public string $deletingBill;

    public function mount()
    {
        $this->form = new CreateDetailForm($this, 'form');
    }

    public function newBill()
    {
        $this->form = new CreateDetailForm($this, 'form');
        $this->bill = null;

        $this->showModal();
    }

    public function editBill(Bill $bill)
    {
        $this->form = new UpdateDetailForm($this, 'form');
        $this->form->setBill($bill);
        $this->bill = $bill;

        $this->showModal();
    }

    public function showModal()
    {
        $this->showingModal = true;
    }

    public function closeModal()
    {
        $this->showingModal = false;
    }

    public function confirmBillDeletion(string $id)
    {
        $this->deletingBill = $id;

        $this->confirmingBillDeletion = true;
    }

    public function deleteBill(Bill $bill)
    {
        $this->authorize('delete', $bill);

        $bill->delete();

        $this->confirmingBillDeletion = false;
    }

    public function save()
    {
        if (empty($this->bill)) {
            $this->authorize('create', Bill::class);
        } else {
            $this->authorize('update', $this->bill);
        }

        $this->form->service_id = $this->service->id;
        $this->form->save();

        $this->closeModal();
    }

    public function sortBy($field)
    {
        if ($this->detailBillsSortField === $field) {
            $this->detailBillsSortDirection =
                $this->detailBillsSortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->detailBillsSortDirection = 'asc';
        }

        $this->detailBillsSortField = $field;
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(5);
    }

    public function getRowsQueryProperty()
    {
        return $this->service
            ->bills()
            ->orderBy(
                $this->detailBillsSortField,
                $this->detailBillsSortDirection
            )
            ->where('created_at', 'like', "%{$this->detailBillsSearch}%");
    }

    public function render()
    {
        return view('livewire.dashboard.services.bills-detail', [
            'detailBills' => $this->rows,
        ]);
    }
}
