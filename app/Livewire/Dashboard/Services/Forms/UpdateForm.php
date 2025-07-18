<?php

namespace App\Livewire\Dashboard\Services\Forms;

use Livewire\Form;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateForm extends Form
{
    public ?Service $service;

    public $vehicle_id = '';

    public $employee_id = '';

    public $status_id = '';

    public $name = '';

    public $description = '';

    public function rules(): array
    {
        return [
            'vehicle_id' => ['required'],
            'employee_id' => ['required'],
            'status_id' => ['required'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
        ];
    }

    public function setService(Service $service)
    {
        $this->service = $service;

        $this->vehicle_id = $service->vehicle_id;
        $this->employee_id = $service->employee_id;
        $this->status_id = $service->status_id;
        $this->name = $service->name;
        $this->description = $service->description;
    }

    public function save()
    {
        $this->validate();

        $data = $this->only([
            'vehicle_id',
            'employee_id',
            'status_id',
            'name',
            'description',
        ]);

        if (empty($this->service->admin_id) && !empty($data['employee_id'])) {
            $user = Auth::user();
            $data['admin_id'] = $user->id;
        }

        $this->service->update($data);
    }
}
