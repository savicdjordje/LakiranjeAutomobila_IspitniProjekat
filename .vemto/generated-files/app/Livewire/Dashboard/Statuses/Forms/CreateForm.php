<?php

namespace App\Livewire\Dashboard\Statuses\Forms;

use Livewire\Form;
use App\Models\Status;
use Livewire\Attributes\Rule;

class CreateForm extends Form
{
    #[Rule('required|string')]
    public $name = '';

    public function save()
    {
        $this->validate();

        $status = Status::create($this->except([]));

        $this->reset();

        return $status;
    }
}
