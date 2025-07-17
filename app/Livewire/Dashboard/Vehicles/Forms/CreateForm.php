<?php

namespace App\Livewire\Dashboard\Vehicles\Forms;

use Livewire\Form;
use App\Models\Vehicle;
use Livewire\Attributes\Rule;

class CreateForm extends Form
{
    #[Rule('required|string')]
    public $licence_plate = '';

    #[Rule('required|string')]
    public $make = '';

    #[Rule('required|string')]
    public $model = '';

    #[Rule('required|date')]
    public $year = '';

    #[Rule('required')]
    public $client_id = '';

    public function save()
    {
        $this->validate();

        $vehicle = Vehicle::create($this->except([]));

        $this->reset();

        return $vehicle;
    }
}
