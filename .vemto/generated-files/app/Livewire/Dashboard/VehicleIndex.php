<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Vehicle;
use Livewire\WithPagination;

class VehicleIndex extends Component
{
    use WithPagination;

    public $search;
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';

    public $queryString = ['search', 'sortField', 'sortDirection'];

    public $confirmingDeletion = false;
    public $deletingVehicle;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDeletion(string $id)
    {
        $this->deletingVehicle = $id;

        $this->confirmingDeletion = true;
    }

    public function delete(Vehicle $vehicle)
    {
        $vehicle->delete();

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
        return Vehicle::query()
            ->orderBy($this->sortField, $this->sortDirection)
            ->where('licence_plate', 'like', "%{$this->search}%");
    }

    public function render()
    {
        return view('livewire.dashboard.vehicles.index', [
            'vehicles' => $this->rows,
        ]);
    }
}
