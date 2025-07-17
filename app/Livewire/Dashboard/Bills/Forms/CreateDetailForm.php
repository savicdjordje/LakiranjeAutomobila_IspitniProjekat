<?php

namespace App\Livewire\Dashboard\Bills\Forms;

use Livewire\Form;
use App\Models\Bill;
use Livewire\Attributes\Rule;

class CreateDetailForm extends Form
{
    public $service_id = null;

    #[Rule('required')]
    public $price = '';

    public function save()
    {
        $this->validate();

        $bill = Bill::create($this->except([]));

        $this->reset();

        return $bill;
    }
}
