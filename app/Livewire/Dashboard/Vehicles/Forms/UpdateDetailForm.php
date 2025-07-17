<?php

namespace App\Livewire\Dashboard\Vehicles\Forms;

use Livewire\Form;
use App\Models\Vehicle;
use Livewire\Attributes\Rule;

class UpdateDetailForm extends Form
{
    public ?Vehicle $vehicle;

    public $licence_plate = '';

    public $make = '';

    public $model = '';

    public $year = '';

    public function rules(): array
    {
        return [
            'licence_plate' => ['required', 'string'],
            'make' => ['required', 'string'],
            'model' => ['required', 'string'],
            'year' => ['required', 'date'],
        ];
    }

    public function setVehicle(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;

        $this->licence_plate = $vehicle->licence_plate;
        $this->make = $vehicle->make;
        $this->model = $vehicle->model;
        $this->year = $vehicle->year;
    }

    public function save()
    {
        $this->validate();

        $this->vehicle->update($this->except(['vehicle']));
    }
}
