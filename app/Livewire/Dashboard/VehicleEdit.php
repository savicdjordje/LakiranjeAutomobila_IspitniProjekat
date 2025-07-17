<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;
use App\Models\Vehicle;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Vehicles\Forms\UpdateForm;

class VehicleEdit extends Component
{
    public ?Vehicle $vehicle = null;

    public UpdateForm $form;
    public Collection $users;

    public function mount(Vehicle $vehicle)
    {
        $this->authorize('view-any', Vehicle::class);

        $this->vehicle = $vehicle;

        $this->form->setVehicle($vehicle);
        $this->users = User::pluck('firstname', 'id');
    }

    public function save()
    {
        $this->authorize('update', $this->vehicle);

        $this->validate();

        $this->form->save();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.dashboard.vehicles.edit', []);
    }
}
