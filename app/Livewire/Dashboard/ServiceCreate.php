<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use App\Models\Status;
use Livewire\Component;
use App\Models\Vehicle;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Services\Forms\CreateForm;
use App\Models\Service;

class ServiceCreate extends Component
{
    use WithFileUploads;

    public CreateForm $form;
    public Collection $vehicles;
    public Collection $employees;
    public Collection $statuses;

    public function mount()
    {
        $this->vehicles = Vehicle::pluck('licence_plate', 'id');
        $this->employees = User::where('role', 'employee')->pluck('firstname', 'id');
        $this->statuses = Status::pluck('name', 'id');
    }

    public function save()
    {
        $this->authorize('create', Service::class);

        $this->validate();

        $service = $this->form->save();

        return redirect()->route('dashboard.services.edit', $service);
    }

    public function render()
    {
        return view('livewire.dashboard.services.create', []);
    }
}
