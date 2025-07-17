<?php

namespace App\Livewire\Dashboard\Statuses\Forms;

use Livewire\Form;
use App\Models\Status;
use Illuminate\Validation\Rule;

class UpdateForm extends Form
{
    public ?Status $status;

    public $name = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }

    public function setStatus(Status $status)
    {
        $this->status = $status;

        $this->name = $status->name;
    }

    public function save()
    {
        $this->validate();

        $this->status->update($this->except(['status']));
    }
}
