<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use App\Models\Status;
use Livewire\Component;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Services\Forms\UpdateForm;

class ServiceEdit extends Component
{
    public ?Service $service = null;

    public UpdateForm $form;
    public Collection $vehicles;
    public Collection $admins;
    public Collection $employees;
    public Collection $statuses;

    public function mount(Service $service)
    {
        $this->authorize('view-any', Service::class);

        $this->service = $service;

        $this->form->setService($service);
        $this->vehicles = Vehicle::pluck('licence_plate', 'id');
        $this->admins = User::where('role', 'admin')->pluck('firstname', 'id');
        $this->employees = User::where('role', 'employee')->pluck('firstname', 'id');
        $this->statuses = Status::pluck('name', 'id');
    }

    public function save()
    {
        $this->authorize('update', $this->service);

        $this->validate();

        $this->form->save();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.dashboard.services.edit', []);
    }
}
