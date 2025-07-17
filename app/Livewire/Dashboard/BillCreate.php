<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Service;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Bills\Forms\CreateForm;

class BillCreate extends Component
{
    use WithFileUploads;

    public CreateForm $form;
    public Collection $services;

    public function mount()
    {
        $this->services = Service::pluck('name', 'id');
    }

    public function save()
    {
        $this->authorize('create', Bill::class);

        $this->validate();

        $bill = $this->form->save();

        return redirect()->route('dashboard.bills.edit', $bill);
    }

    public function render()
    {
        return view('livewire.dashboard.bills.create', []);
    }
}
