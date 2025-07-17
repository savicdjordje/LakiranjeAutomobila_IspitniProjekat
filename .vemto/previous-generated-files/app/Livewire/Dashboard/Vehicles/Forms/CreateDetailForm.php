<?php

namespace App\Livewire\Dashboard\Vehicles\Forms;

use Livewire\Form;
use App\Models\Vehicle;
use Livewire\Attributes\Rule;

class CreateDetailForm extends Form
{
    public $client_id = null;

    #[Rule('required|string')]
    public $licence_plate = '';

    #[Rule('required|string')]
    public $make = '';

    #[Rule('required|string')]
    public $model = '';

    #[Rule('required|date')]
    public $year = '';

    public function save()
    {
        $this->validate();

        $vehicle = Vehicle::create($this->except([]));

        $this->reset();

        return $vehicle;
    }
}
