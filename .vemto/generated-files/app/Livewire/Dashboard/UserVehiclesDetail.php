<?php

namespace App\Livewire\Dashboard;

use Livewire\Form;
use App\Models\User;
use Livewire\Component;
use App\Models\Vehicle;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Dashboard\Vehicles\Forms\CreateDetailForm;
use App\Livewire\Dashboard\Vehicles\Forms\UpdateDetailForm;

class UserVehiclesDetail extends Component
{
    use WithFileUploads, WithPagination;

    public CreateDetailForm|UpdateDetailForm $form;

    public ?Vehicle $vehicle;
    public User $user;

    public $showingModal = false;

    public $detailVehiclesSearch = '';
    public $detailVehiclesSortField = 'updated_at';
    public $detailVehiclesSortDirection = 'desc';

    public $queryString = [
        'detailVehiclesSearch',
        'detailVehiclesSortField',
        'detailVehiclesSortDirection',
    ];

    public $confirmingVehicleDeletion = false;
    public string $deletingVehicle;

    public function mount()
    {
        $this->form = new CreateDetailForm($this, 'form');
    }

    public function newVehicle()
    {
        $this->form = new CreateDetailForm($this, 'form');
        $this->vehicle = null;

        $this->showModal();
    }

    public function editVehicle(Vehicle $vehicle)
    {
        $this->form = new UpdateDetailForm($this, 'form');
        $this->form->setVehicle($vehicle);
        $this->vehicle = $vehicle;

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

    public function confirmVehicleDeletion(string $id)
    {
        $this->deletingVehicle = $id;

        $this->confirmingVehicleDeletion = true;
    }

    public function deleteVehicle(Vehicle $vehicle)
    {
        $this->authorize('delete', $vehicle);

        $vehicle->delete();

        $this->confirmingVehicleDeletion = false;
    }

    public function save()
    {
        if (empty($this->vehicle)) {
            $this->authorize('create', Vehicle::class);
        } else {
            $this->authorize('update', $this->vehicle);
        }

        $this->form->client_id = $this->user->id;
        $this->form->save();

        $this->closeModal();
    }

    public function sortBy($field)
    {
        if ($this->detailVehiclesSortField === $field) {
            $this->detailVehiclesSortDirection =
                $this->detailVehiclesSortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->detailVehiclesSortDirection = 'asc';
        }

        $this->detailVehiclesSortField = $field;
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(5);
    }

    public function getRowsQueryProperty()
    {
        return $this->user
            ->vehicles()
            ->orderBy(
                $this->detailVehiclesSortField,
                $this->detailVehiclesSortDirection
            )
            ->where('licence_plate', 'like', "%{$this->detailVehiclesSearch}%");
    }

    public function render()
    {
        return view('livewire.dashboard.users.vehicles-detail', [
            'detailVehicles' => $this->rows,
        ]);
    }
}
