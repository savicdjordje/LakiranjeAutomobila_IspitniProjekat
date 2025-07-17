<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Vehicles\Forms\CreateForm;

class VehicleCreate extends Component
{
    use WithFileUploads;

    public CreateForm $form;
    public Collection $users;

    public function mount()
    {
        $this->users = User::pluck('firstname', 'id');
    }

    public function save()
    {
        $this->authorize('create', Vehicle::class);

        $this->validate();

        $vehicle = $this->form->save();

        return redirect()->route('dashboard.vehicles.edit', $vehicle);
    }

    public function render()
    {
        return view('livewire.dashboard.vehicles.create', []);
    }
}
