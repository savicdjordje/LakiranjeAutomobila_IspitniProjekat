<?php

namespace App\Livewire\Dashboard;

use App\Models\Bill;
use Livewire\Component;
use App\Models\Service;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Bills\Forms\UpdateForm;

class BillEdit extends Component
{
    public ?Bill $bill = null;

    public UpdateForm $form;
    public Collection $services;

    public function mount(Bill $bill)
    {
        $this->authorize('view-any', Bill::class);

        $this->bill = $bill;

        $this->form->setBill($bill);
        $this->services = Service::pluck('name', 'id');
    }

    public function save()
    {
        $this->authorize('update', $this->bill);

        $this->validate();

        $this->form->save();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.dashboard.bills.edit', []);
    }
}
