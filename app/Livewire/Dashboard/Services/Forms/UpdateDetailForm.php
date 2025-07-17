<?php

namespace App\Livewire\Dashboard\Services\Forms;

use Livewire\Form;
use App\Models\Service;
use Livewire\Attributes\Rule;

class UpdateDetailForm extends Form
{
    public ?Service $service;

    public $employee_id = '';

    public $admin_id = '';

    public $status_id = '';

    public $name = '';

    public $description = '';

    public function rules(): array
    {
        return [
            'employee_id' => ['required'],
            'admin_id' => ['required'],
            'status_id' => ['required'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
        ];
    }

    public function setService(Service $service)
    {
        $this->service = $service;

        $this->employee_id = $service->employee_id;
        $this->admin_id = $service->admin_id;
        $this->status_id = $service->status_id;
        $this->name = $service->name;
        $this->description = $service->description;
    }

    public function save()
    {
        $this->validate();

        $this->service->update(
            $this->except(['service', 'employee_id', 'admin_id', 'status_id'])
        );
    }
}
