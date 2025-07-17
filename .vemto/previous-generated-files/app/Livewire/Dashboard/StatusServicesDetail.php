<?php

namespace App\Livewire\Dashboard;

use Livewire\Form;
use App\Models\User;
use App\Models\Status;
use Livewire\Component;
use App\Models\Service;
use App\Models\Vehicle;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Dashboard\Services\Forms\CreateDetailForm;
use App\Livewire\Dashboard\Services\Forms\UpdateDetailForm;

class StatusServicesDetail extends Component
{
    use WithFileUploads, WithPagination;

    public CreateDetailForm|UpdateDetailForm $form;

    public ?Service $service;
    public Status $status;

    public Collection $vehicles;
    public Collection $admins;
    public Collection $employees;

    public $showingModal = false;

    public $detailServicesSearch = '';
    public $detailServicesSortField = 'updated_at';
    public $detailServicesSortDirection = 'desc';

    public $queryString = [
        'detailServicesSearch',
        'detailServicesSortField',
        'detailServicesSortDirection',
    ];

    public $confirmingServiceDeletion = false;
    public string $deletingService;

    public function mount()
    {
        $this->form = new CreateDetailForm($this, 'form');

        $this->vehicles = Vehicle::pluck('licence_plate', 'id');
        $this->admins = User::where('role', 'admin')->pluck('firstname', 'id');
        $this->employees = User::where('role', 'employee')->pluck('firstname', 'id');
    }

    public function newService()
    {
        $this->form = new CreateDetailForm($this, 'form');
        $this->service = null;

        $this->showModal();
    }

    public function editService(Service $service)
    {
        $this->form = new UpdateDetailForm($this, 'form');
        $this->form->setService($service);
        $this->service = $service;

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

    public function confirmServiceDeletion(string $id)
    {
        $this->deletingService = $id;

        $this->confirmingServiceDeletion = true;
    }

    public function deleteService(Service $service)
    {
        $this->authorize('delete', $service);

        $service->delete();

        $this->confirmingServiceDeletion = false;
    }

    public function save()
    {
        if (empty($this->service)) {
            $this->authorize('create', Service::class);
        } else {
            $this->authorize('update', $this->service);
        }

        $this->form->status_id = $this->status->id;
        $this->form->save();

        $this->closeModal();
    }

    public function sortBy($field)
    {
        if ($this->detailServicesSortField === $field) {
            $this->detailServicesSortDirection =
                $this->detailServicesSortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->detailServicesSortDirection = 'asc';
        }

        $this->detailServicesSortField = $field;
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(5);
    }

    public function getRowsQueryProperty()
    {
        return $this->status
            ->services()
            ->orderBy(
                $this->detailServicesSortField,
                $this->detailServicesSortDirection
            )
            ->where('name', 'like', "%{$this->detailServicesSearch}%");
    }

    public function render()
    {
        return view('livewire.dashboard.statuses.services-detail', [
            'detailServices' => $this->rows,
        ]);
    }
}
