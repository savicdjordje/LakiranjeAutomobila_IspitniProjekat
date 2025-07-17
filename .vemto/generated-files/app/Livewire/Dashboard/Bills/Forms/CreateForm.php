<?php

namespace App\Livewire\Dashboard\Bills\Forms;

use Livewire\Form;
use App\Models\Bill;
use Livewire\Attributes\Rule;

class CreateForm extends Form
{
    #[Rule('required')]
    public $service_id = '';

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
