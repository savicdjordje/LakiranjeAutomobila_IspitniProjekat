<?php

namespace App\Livewire\Dashboard\Services\Forms;

use Livewire\Form;
use App\Models\Service;
use Livewire\Attributes\Rule;

class CreateDetailForm extends Form
{
    public $vehicle_id = null;

    #[Rule('required')]
    public $employee_id = '';

    #[Rule('required')]
    public $admin_id = '';

    #[Rule('required')]
    public $status_id = '';

    #[Rule('required|string')]
    public $name = '';

    #[Rule('required|string')]
    public $description = '';

    public function save()
    {
        $this->validate();

        $service = Service::create($this->except([]));

        $this->reset();

        return $service;
    }
}
